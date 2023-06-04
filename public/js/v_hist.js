function plot(X = [], xName = [], mode) {
    var data = [];
    i = 0;
    X.forEach(x => {
        data.push({
            x: x,
            name: xName[i],
            type: 'histogram',
        })
        i++;
    });

    var layout = { barmode: mode, title: "Cliquez pour saisir le titre" };

    Plotly.newPlot('tester', data, layout, { editable: true });
}
plot();
function loadData() {
    var qry = new XMLHttpRequest(),
        csrf = document.querySelector("meta[name='csrf-token']"),
        form = document.getElementById("form_param"),
        formd = new FormData(form);
    qry.open('POST', "http://localhost:8000/histogramme_vertical");
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