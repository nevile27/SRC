function plot(X = [], y = [], xName) {
    var data = [];
    if(y.length>15){
        Y = [];
        for (let i = 0; i < y.length; i=i+15) {
            Y.push(y.slice(i,i+15));
        }
        j = 1;
        var p = document.getElementById('v1');
        p.innerHTML = "";
        Y.forEach(el => {
            var div = document.createElement('div');
            div.id = "tester"+j;
            p.appendChild(div);
            k = 0;
            X.forEach(x => {
                data.push({
                    x:x,
                    y:el,
                    name: xName[k],
                    type: 'bar',
                    orientation: 'h',
                });
                k++;
            });

            var layout = { barmode: 'group', title: "Cliquez pour saisir le titre" };

            Plotly.newPlot('tester'+j, data, layout, { editable: true });
            data = [];
            j++;
        });
    }else{
        X.forEach(el => {
            data.push({
                x:el,
                y:y,
                name: 'name',
                type: 'bar',
                orientation: 'h',
            })
        });

        var layout = { barmode: 'group', title: "Cliquez pour saisir le titre" };

        Plotly.newPlot('tester', data, layout, { editable: true });
    }
}
plot();
function loadData() {
    var qry = new XMLHttpRequest(),
        csrf = document.querySelector("meta[name='csrf-token']"),
        form = document.getElementById("form_param"),
        formd = new FormData(form);
    qry.open('POST', "http://localhost:8000/batonnet_horizontal");
    qry.setRequestHeader('X-CSRF-TOKEN',csrf.getAttribute('content'));
    qry.onreadystatechange = function(){
        if(qry.readyState == qry.DONE && qry.status == 200){
            //alert(qry.response);
            var data = JSON.parse(qry.response);
            plot(data['x'],data['y'],data['xName']);
        }else if(qry.readyState == qry.DONE && qry.status != 200){
            alert('Une erreur s\'est produite:\n\nCode:' + qry.status + ',\nType:' + qry.statusText);
        }
    };
    qry.send(formd);
}

var button = document.getElementById("form_param");

button.onsubmit = function (e) {
    e.preventDefault();
    loadData();
}