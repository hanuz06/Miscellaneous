import { SIGNUP, LOGIN } from "../../types";

const initialState = {
  token: "",
};

export default (state = initialState, action) => {
  switch (action.type) {
    case SIGNUP:
      return {
        orders: action.token,
      };
    default:
      return state;
  }
};
