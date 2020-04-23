import { ADD_TO_CART } from "../../types";

export default addToCart = (product) => {
  return { type: ADD_TO_CART, product: product };
};
