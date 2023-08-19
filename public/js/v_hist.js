function plot(X = [], xName = [], mode) {
    var data = [];
    i = 0;
    if(mode == "stack"){
        X.forEach(x => {
            data.push({
                x: x,
                name: xName[i],
                type: 'histogram',
            })
            i++;
        });
    }else{
        pas = 1/X.length;
        op = 1;
        X.forEach(x => {
            data.push({
                x: x,
                opacity: op,
                name: xName[i],
                type: 'histogram',
            })
            op-=pas;
            i++;
        });
    }

    var layout = {
        barmode: mode,
        bargap: 0.01, 
        title: "Cliquez pour saisir le titre",
        xaxis: {title: "Valeurs"},
        yaxis: {title: "Nombre de valeurs"},
    };

    Plotly.newPlot('tester', data, layout, { editable: true });
}
plot();
function loadData() {
    var qry = new XMLHttpRequest(),
        csrf = document.querySelector("meta[name='csrf-token']"),
        hote = document.querySelector("input[name='hote']"),
        form = document.getElementById("form_param"),
        formd = new FormData(form);
    qry.open('POST', hote.value + "/histogramme_vertical");
    qry.setRequestHeader('X-CSRF-TOKEN', csrf.getAttribute('content'));
    qry.onreadystatechange = function () {
        if (qry.readyState == qry.DONE && qry.status == 200) {
            //alert(qry.response);
            var data = JSON.parse(qry.response);
            plot(data['x'], data['xName'], data['mode']);
        } else if (qry.readyState == qry.DONE && qry.status != 200) {
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