import { ADD_ORDER, FETCH_ORDERS } from "../../types";
import Order from "../../models/order";

export const fetchOrders = () => {
  return async (dispatch, getState) => {
    // getState() of redux-thunk outputs the whole redux state
    const userId = getState().auth.userId;
    try {
      const res = await fetch(
        `https://react-native-shop-app-9b2b1.firebaseio.com/orders/${userId}.json`
      );

      if (!res.ok) {
        throw new Error("Something is wrong with fetching orders!");
      }

      const resData = await res.json();

      const fetchedOrders = [];

      for (const key in resData) {
        fetchedOrders.push(
          new Order(
            key,
            resData[key].cartItems,
            resData[key].totalAmount,
            new Date(resData[key].date)
          )
        );
      }
      dispatch({ type: FETCH_ORDERS, orders: fetchedOrders });
    } catch (err) {
      // send to custom analytics server
      throw err;
    }
  };
};

export const addOrder = (cartItems, totalAmount) => {
  // allow execute any async code thanks to redux-thunk
  return async (dispatch, getState) => {
    // getState() of redux-thunk outputs the whole redux state
    const token = getState().auth.token;
    const userId = getState().auth.userId;
    const date = new Date();
    const res = await fetch(
      `https://react-native-shop-app-9b2b1.firebaseio.com/orders/${userId}.json?auth=${token}`,
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          cartItems,
          totalAmount,
          date: new Date().toISOString(),
        }),
      }
    );

    if (!res.ok) {
      throw new Error("Failed to update. Something web wrong!");
    }

    const resData = await res.json();

    dispatch({
      type: ADD_ORDER,
      orderData: {
        id: resData.name,
        items: cartItems,
        amount: totalAmount,
        date: date,
      },
    });
  };
};
