function plot(Y = [], yName = [], mode) {
    var data = [];
    i = 0;
    if(mode == "stack"){
        Y.forEach(y => {
            data.push({
                y: y,
                name: yName[i],
                type: 'histogram',
            })
            i++;
        });
    }else{
        pas = 1/Y.length;
        op = 1;
        Y.forEach(y => {
            data.push({
                y: y,
                opacity: op,
                name: yName[i],
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
        yaxis: {title: "Valeurs"},
        xaxis: {title: "Nombre de valeurs"},
    };

    Plotly.newPlot('tester', data, layout, { editable: true });
}
plot();
function loadData() {
    var qry = new XMLHttpRequest(),
        csrf = document.querySelector("meta[name='csrf-token']"),
        form = document.getElementById("form_param"),
        formd = new FormData(form);
    qry.open('POST', "http://localhost:8000/histogramme_horizontal");
    qry.setRequestHeader('X-CSRF-TOKEN', csrf.getAttribute('content'));
    qry.onreadystatechange = function () {
        if (qry.readyState == qry.DONE && qry.status == 200) {
            //alert(qry.response);
            var data = JSON.parse(qry.response);
            plot(data['y'], data['yName'], data['mode']);
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