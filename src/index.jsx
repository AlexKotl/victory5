import React from 'react';
import {render} from 'react-dom';
import CompareApp from './components/CompareApp/CompareApp.jsx';
//import {EventEmitter} from 'fbemitter';

//window.ee = new EventEmitter();

render (
<CompareApp />,
    document.getElementById('root')
)