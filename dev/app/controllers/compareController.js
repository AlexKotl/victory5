import config from './../config'
import CompareView from './../views/compare/compareView'
import CompareModel from './../models/compareModel'

export default class CompareController {

    constructor() {
        this.model = new CompareModel(config)
    }

    show() {

        this.view = new CompareView('application')
        this.view.render()

    }

}