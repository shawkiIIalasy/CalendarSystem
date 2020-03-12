const _daysInMonths = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
const weekdayLabels = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
document.addEventListener("DOMContentLoaded", function (event) {
    object.f();
});

class site {
    obj = document.getElementById('content');
    monthLabels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    month = 1;
    year = 1900;
    m = 1;
    y = 1996;
    d = 1;

    constructor() {
        this.m = new Date().getMonth();
        this.y = new Date().getFullYear();
        this.d = new Date().getDate();
        this.month = new Date().getMonth();
        this.year = new Date().getFullYear();
        this.ini();
    }

    ini() {
        this.nextButton();
        this.previousButton();
        this.setHeadMonth();
        //this.getTable();
    }

    setHeadMonth() {
        var element = document.createElement('span');
        element.style.fontWeight = 'bold';
        element.style.fontSize='30px';
        element.className = 'd-flex justify-content-center';
        element.innerHTML = this.monthLabels[this.m] + ',' + this.y;
        this.obj.appendChild(element);
    }


    nextButton() {
        var button = document.createElement('button');
        button.innerHTML = 'Next';
        button.style.float = 'right';
        button.style.marginBottom='10px';
        button.className = 'btn btn-primary';
        button.setAttribute('onclick', 'object.incrementMonth()');
        this.obj.appendChild(button);


    }

    previousButton() {
        var button = document.createElement('button');
        button.innerHTML = 'Previous';
        button.style.float = 'left';
        button.style.marginBottom='10px';
        button.className = 'btn btn-primary';
        button.setAttribute('onclick', 'object.decrementMonth()');
        this.obj.appendChild(button);

    }

    decrementMonth() {
        if (this.m == 1) {
            this.m = 11;
            this.y--;
        } else {
            this.m--;
        }
        this.setHeadMonth();
        this.removeElement('content');
        this.createElement();
        this.obj = document.getElementById('content');
        this.ini();
        this.f();
    }

    incrementMonth() {
        if (this.m == 11) {
            this.m = 1;
            this.y++;
        } else {
            this.m++;
        }
        this.setHeadMonth();
        this.removeElement('content');
        this.createElement();
        this.obj = document.getElementById('content');
        this.ini();
        this.f();
    }

    getheaders(thead) {
        weekdayLabels.forEach(element => {
            var th = document.createElement('th');
            th.appendChild(document.createTextNode(element));
            thead.appendChild(th);
        });
        return thead;
    }

    getTable() {
        var count = 1;
        var table = document.createElement('table');
        table.className='table';
        var thead = document.createElement('thead');
        thead = this.getheaders(thead);
        var tbdy = document.createElement('tbody');
        table.style.width = '100%';
        table.setAttribute('border', '1');
        for (var i = 0; i < 5; i++) {
            var tr = document.createElement('tr');
            for (var j = 0; j < 7; j++) {
                var td = document.createElement('td');
                if (this.d === count && this.month == this.m && this.year == this.y) {
                    td.style.background = '#3490dc';
                    td.style.color = '#ffffff';
                }
                if (count > _daysInMonths[this.m]) {
                    td.style.background = '#ffffff';
                    td.appendChild(document.createTextNode("---"));
                } else
                    td.appendChild(document.createTextNode(count));
                tr.appendChild(td);
                count++;
            }
            tbdy.appendChild(tr);
        }
        table.appendChild(thead);
        table.appendChild(tbdy);
        this.obj.appendChild(table);
    }

    removeElement(elementId) {
        var element = document.getElementById(elementId);
        element.parentNode.removeChild(element);
    }

    createElement() {
        var element = document.createElement('div');
        element.setAttribute('id', 'content');
        document.getElementById('ta').appendChild(element);
    }

    f() {
        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: '/event',
            data: {'y': object.y, 'm': object.m},
            success: function (data) {
                //console.log(data);
                object.addData(data);
            }
        });
    }

    addData(object) {

        this.removeElement('content');
        this.createElement();
        this.obj = document.getElementById('content');
        this.nextButton();
        this.previousButton();
        this.setHeadMonth();
        var count = 1;
        var table = document.createElement('table');
        table.className='table table-bordered ';
        var thead = document.createElement('thead');
        thead.className='bg-primary text-white';
        thead = this.getheaders(thead);
        var tbdy = document.createElement('tbody');
        table.style.width = '100%';
        table.setAttribute('border', '1');
        for (var i = 0; i < 5; i++) {
            var tr = document.createElement('tr');
            for (var j = 0; j < 7; j++) {
                var td = document.createElement('td');
                var mybr = document.createElement('br');

                if (count > _daysInMonths[this.m]) {
                    td.style.background = '#ffffff';
                    td.appendChild(mybr);
                } else {

                    var box=document.createElement('span');
                    box.style.background='#d2e3fc';
                    box.style.color="#70757a";
                    box.style.fontSize="12px";
                    box.style.borderRadius='100px';
                    box.style.padding='7px';
                    box.innerHTML=count;
                    if (this.d === count && this.month == this.m && this.year == this.y) {
                        box.style.background = '#3490dc';
                        box.style.color='#ffffff';
                    }
                    td.appendChild(box);
                    td.appendChild(mybr);
                    for (var en in object) {
                        var today=new Date();
                        var start = new Date(object[en].start_date);
                        var end = new Date(object[en].end_date);
                        if (start.getDate() == count && this.m>=start.getMonth() && this.y==start.getFullYear()) {
                            var text=document.createElement('div');
                            var link=document.createElement('a');
                            link.innerHTML=object[en].title;
                            link.href="/event/"+object[en].id;
                            text.style.background = '#3490dc';
                            link.style.color = '#ffffff';
                            text.style.padding='5px';
                            text.style.fontSize='10px';
                            text.style.margin='2px';
                            text.style.borderRadius='5px';
                            text.appendChild(link);
                            td.appendChild(text);
                            td.appendChild(mybr);
                        }
                    }
                }
                tr.appendChild(td);
                count++;
            }
            tbdy.appendChild(tr);
        }
        table.appendChild(thead);
        table.appendChild(tbdy);
        this.obj.appendChild(table);
    }

}

