import React from "react";
import ReactDOM from "react-dom";
import {
    BrowserRouter as Router,
    Switch,
    Route,
    Link
  } from "react-router-dom";
import Home from "./Home/Home";
import About from "./About/About";
import 'bootstrap/dist/css/bootstrap.min.css';


function App() {
    return (
        <>
     <div>
         <Router>
         <Link to="/">Home</Link>
      <Link to="/about">About</Link>
      <Switch>
        <Route path="/about">
          <About />
        </Route>
        <Route path="/">
          <Home />
        </Route>
      </Switch>
      </Router>
    </div>
    

</>
    );
}

export default App;

if (document.getElementById("root")) {
    ReactDOM.render(<App />, document.getElementById("root"));
}
