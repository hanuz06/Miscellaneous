import {
  DELETE_PRODUCT,
  CREATE_PRODUCT,
  UPDATE_PRODUCT,
  SET_PRODUCTS,
} from "../../types";
import Product from "../../models/product";

export const fetchProducts = () => {
  return async (dispatch) => {
    try {
      const res = await fetch(
        "https://react-native-shop-app-9b2b1.firebaseio.com/products.json"
      );

      if (!res.ok) {
        throw new Error("Something is wrong!");
      }

      const resData = await res.json();

      const fetchedProducts = [];

      for (const key in resData) {
        fetchedProducts.push(
          new Product(
            key,
            "u1",
            resData[key].title,
            resData[key].imageUrl,
            resData[key].description,
            resData[key].price
          )
        );
      }

      dispatch({ type: SET_PRODUCTS, products: fetchedProducts });
    } catch (err) {
      // send to custom analytics server
      throw err;
    }
  };
};

export const deleteProduct = (productId) => {
  return async (dispatch) => {
    const res = await fetch(
      `https://react-native-shop-app-9b2b1.firebaseio.com/products/${productId}.json`,
      {
        method: "DELETE",
      }
    );

    if (!res.ok) {
      throw new Error("Failed to update. Something web wrong!");
    }

    dispatch({ type: DELETE_PRODUCT, productId: productId });
  };
};

export const createProduct = (title, description, imageUrl, price) => {
  // allow execute any async code thanks to redux-thunk
  return async (dispatch) => {
    const res = await fetch(
      "https://react-native-shop-app-9b2b1.firebaseio.com/products.json",
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          title,
          description,
          imageUrl,
          price,
        }),
      }
    );

    const resData = await res.json();

    // dispatch to redux adding id from the fetch operation
    dispatch({
      type: CREATE_PRODUCT,
      productData: {
        id: resData.name,
        title,
        description,
        imageUrl,
        price,
      },
    });
  };
};

export const updateProduct = (id, title, description, imageUrl) => {
  return async (dispatch) => {
    const res = await fetch(
      `https://react-native-shop-app-9b2b1.firebaseio.com/products/${id}.json`,
      {
        method: "PATCH",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          title,
          description,
          imageUrl,
        }),
      }
    );

    if (!res.ok) {
      throw new Error("Failed to update. Something web wrong!");
    }

    dispatch({
      type: UPDATE_PRODUCT,
      productId: id,
      productData: {
        title,
        description,
        imageUrl,
      },
    });
  };
};
