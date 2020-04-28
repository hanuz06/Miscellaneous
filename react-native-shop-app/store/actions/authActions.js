import { SIGNUP, LOGIN } from "../../types";

export const signup = (email, password) => {
  return async (dispatch) => {
    try {
      const res = await fetch(
        "https://identitytoolkit.googleapis.com/v1/accounts:signUp?key=AIzaSyAVzjgOyi9fE6eP8Ia14MySZFeOXmJTrCY",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            email: email,
            password: password,
            returnSecureToken: true,
          }),
        }
      );

      if (!res.ok) {
        throw new Error("Oops, something is wrong with login");
      }

      const resData = await res.json();

      console.log("resData ", resData);

      dispatch({ type: SIGNUP });
    } catch (err) {
      // send to custom analytics server
      throw err;
    }
  };
};

export const login = (email, password) => {
  return async (dispatch) => {
    try {
      const res = await fetch(
        "https://identitytoolkit.googleapis.com/v1/accounts:signInWithPassword?key=AIzaSyAVzjgOyi9fE6eP8Ia14MySZFeOXmJTrCY",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            email: email,
            password: password,
            returnSecureToken: true,
          }),
        }
      );

      if (!res.ok) {
        throw new Error("Oops, something is wrong with login");
      }

      const resData = await res.json();

      console.log("resData ", resData);

      dispatch({ type: LOGIN });
    } catch (err) {
      // send to custom analytics server
      throw err;
    }
  };
};

