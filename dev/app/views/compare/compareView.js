export default class compareView {

    constructor(target) {
        
        this.target = target
        
    }

    createSelectFromData(data) {

        const add = (str, val) => {
            const date = new Date(val.timestamp * 1000)
            return str += `<option value="${ val.filename }"> ${ date.getDate() }/${ date.getMonth() }/${ date.getFullYear() } ${ date.getHours() }:${ date.getMinutes() } </option>`
        }

        return data.reduce(add, '')
    }

    createImgTag(obj) {
        return `<img src="/upload/screenshots/${ obj.filename }" alt="" />`
    }

    render(data) {

        // ${ this.createImgTag(data[0]) }
        // ${ this.createImgTag(data[data.length-1]) }

        document.getElementById(this.target).innerHTML = `
            <div class="compareBlock">
                <div class="sideSelect left">
                    <select size="2" id="picture1">
                        ${ this.createSelectFromData(data) }
                    </select>
                </div>
                           
                <div id="display"></div>
                
                <div class="sideSelect right">
                    <select size="2" id="picture2">
                        ${ this.createSelectFromData(data) }
                    </select>
                </div>
            </div>
        `

    }

}