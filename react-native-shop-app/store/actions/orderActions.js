import { ADD_ORDER, FETCH_ORDERS } from "../../types";
import Order from '../../models/order'

export const fetchOrders = () => {
  return async (dispatch) => {
    try {
      const res = await fetch(
        "https://react-native-shop-app-9b2b1.firebaseio.com/orders/u1.json"
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
  return async (dispatch) => {
    const date = new Date();
    const res = await fetch(
      "https://react-native-shop-app-9b2b1.firebaseio.com/orders/u1.json",
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
