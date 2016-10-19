import config from './../config'
import CompareView from './../views/compare/compareView'
import CompareModel from './../models/compareModel'

export default class CompareController {

    constructor() {
        this.model = new CompareModel(config)

        // init compare slider
        this.slider = new juxtapose.JXSlider('#display',
            [
                {
                    src: '/images/stuff/sample1.jpg',
                    label: '2009',
                    credit: 'Image Credit'
                },
                {
                    src: '/images/stuff/sample2.jpg',
                    label: '2014',
                    credit: "Image Credit"
                }
            ],
            {
                animate: true,
                showLabels: true,
                showCredits: true,
                startingPosition: "50%",
                makeResponsive: true
            }
        );
    }

    show() {

        this.view = new CompareView('application')

        this.dates = this.model.getAllDates().then(data => {
            this.view.render(data)
        });


    }

}