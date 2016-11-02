import React, {Component} from 'react';
import RangeSelect from './../RangeSelect/RangeSelect.jsx';
import CompareDisplay from './../CompareDisplay/CompareDisplay.jsx';

export default class CompareApp extends Component {
    state = {
        dateRange: {}
    }

    componentDidMount() {
        // get ranges
        fetch('/api/list')
            .then(result => result.json())
            .then(result => {
                this.setState({
                    dateRange: result
                });
            })
            .then(() => {
                //console.log(this.state);
            })
            .catch(alert);


    }

    render() {
        return (
            <div className="compareApp">
                <div></div>
                <div><CompareDisplay /></div>
                <div><RangeSelect /></div>
            </div>
        )
    }
}