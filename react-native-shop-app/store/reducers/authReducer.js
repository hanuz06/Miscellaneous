import { SIGNUP, LOGIN, AUTHENTICATE } from "../../types";

const initialState = {
  token: null,
  userId: null,
};

export default (state = initialState, action) => {
  switch (action.type) {
    case AUTHENTICATE:
      return {
        token: action.token,
        userId: action.userId,
      };
    // case LOGIN:
    //   return {
    //     token: action.token,
    //     userId: action.userId,
    //   };
    // case SIGNUP:
    //   return {
    //     token: action.token,
    //     userId: action.userId, 
    //   };
    default:
      return state;
  }
};
