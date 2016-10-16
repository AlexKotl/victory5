export default class compareView {

    constructor(target) {
        
        this.target = target
        
    }

    render() {

        document.getElementById(this.target).innerHTML = "Works!"

    }

}