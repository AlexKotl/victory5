export default class compareView {

    constructor(target) {
        
        this.target = target
        
    }

    render() {

        document.getElementById(this.target).innerHTML = `
            <div class="sideSelect left">
                <select></select>
            </div>

            <div id="display">
                <div id="first"></div>
                <div id="second"></div>
            </div>
            
            <div class="sideSelect right">
                <select></select>
            </div>
        `

    }

}