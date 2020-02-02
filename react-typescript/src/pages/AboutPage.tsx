import React from "react";
import { useHistory } from "react-router-dom";

export const AboutPage: React.FC = () => {
  const history = useHistory();
  return (
    <>
      <h1>Information page</h1>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam beatae
        dolor architecto, officiis ducimus facilis commodi reprehenderit eveniet
        repudiandae aspernatur reiciendis tenetur, ipsam alias at eum quia
        minima soluta fugiat!
      </p>
      <button className="btn" onClick={() => history.push("/")}>
        Back to Todo list
      </button>
    </>
  );
};
