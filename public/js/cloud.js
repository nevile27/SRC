function plot(x = [], Y = [], yName, mode) {
    var data = [];
    if(x.length>50){
        X = [];
        for (let i = 0; i < x.length; i=i+50) {
            X.push(x.slice(i,i+50));
        }
        j = 1;
        var p = document.getElementById('v1');
        p.innerHTML = "";
        X.forEach(el => {
            var div = document.createElement('div');
            div.id = "tester"+j;
            p.appendChild(div);
            $k = 0;
            Y.forEach(y => {
                data.push({
                    x:el,
                    y:y,
                    name: yName[$k],
                    mode: mode,
                    type: 'scatter',
                });
                $k++;
            });

            var layout = { barmode: 'group', title: "Cliquez pour saisir le titre" };

            Plotly.newPlot('tester'+j, data, layout, { editable: true });
            data = [];
            j++;
        });
    }else{
        Y.forEach(el => {
            data.push({
                x:x,
                y:el,
                name: 'name',
                type: 'scatter',
            })
        });

        var layout = { title: "Cliquez pour saisir le titre" };

        Plotly.newPlot('tester', data, layout, { editable: true });
    }
}
plot();
function loadData() {
    var qry = new XMLHttpRequest(),
        csrf = document.querySelector("meta[name='csrf-token']"),
        form = document.getElementById("form_param"),
        formd = new FormData(form);
    qry.open('POST', "http://localhost:8000/nuage_de_points");
    qry.setRequestHeader('X-CSRF-TOKEN',csrf.getAttribute('content'));
    qry.onreadystatechange = function(){
        if(qry.readyState == qry.DONE && qry.status == 200){
            //alert(qry.response);
            var data = JSON.parse(qry.response);
            plot(data['x'],data['y'],data['yName'],data['mode']);
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