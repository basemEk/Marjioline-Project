import React, {Component} from 'react';
import ReactDOM from 'react-dom';

class Home extends Component() {
    render() {
        return (
            <div className="container">

            </div>
        );
    }
}
export default Home;

if (document.getElementById('example')) {
    ReactDOM.render(<Home />, document.getElementById('example'));
}
