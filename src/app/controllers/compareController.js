import config from './../config'
import CompareView from './../views/compare/compareView'
import CompareModel from './../models/compareModel'

export default class CompareController {

    constructor() {

        this.model = new CompareModel(config)

    }

    show() {

        this.view = new CompareView('application')

        this.dates = this.model.getAllDates().then(data => {

            this.view.render(data)

            // init compare slider
            this.slider = new juxtapose.JXSlider('#display',
                [
                    {
                        src: '/images/stuff/sample1.jpg',
                        label: 'До'
                    },
                    {
                        src: '/images/stuff/sample2.jpg',
                        label: 'После'
                    }
                ],
                {
                    animate: true,
                    showLabels: true,
                    showCredits: false,
                    startingPosition: "50%",
                    makeResponsive: false
                }
            );
            //this.slider._onLoaded();

            // attach events
            document.getElementById('picture1').addEventListener('change', this.changePicture.bind(this))
            document.getElementById('picture2').addEventListener('change', this.changePicture.bind(this))

        })




    }

    changePicture(e) {

        if (e.target.id == 'picture1') {
            this.slider.imgBefore.image.src = '/upload/screenshots/' + e.target.value
        }
        else {
            this.slider.imgAfter.image.src = '/upload/screenshots/' + e.target.value
        }

    }

}