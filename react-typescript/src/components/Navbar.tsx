import React from "react";
import { NavLink } from "react-router-dom";

export const Navbar: React.FunctionComponent = () => (
  <nav>
    <div className="nav-wrapper purple darken-2 px1">
      <NavLink to="/" className="brand-logo">
        React + Typescript
      </NavLink>
      <ul className="right hide-on-med-and-down">
        <li>
          <NavLink to="/">Todo list</NavLink>
        </li>
        <li>
          <NavLink to="/about">Information</NavLink>
        </li>
      </ul>
    </div>
  </nav>
);
