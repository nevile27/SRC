function plot(lab = [], Val = [], text = []) {
    var data = [], annots = [], l = Val.length, pos = 1/(2*l);
    i = 0;
    Val.forEach(val => {
        data.push({
            values: val,
            labels: lab,
            type: 'pie',
            hole: 0,
            domain: (l>3)? {row:i,column:0}:{row:0,column:i},
        })
        annots.push({
            showarrow: false,
            text: text[i],
            x: pos,
            y: 0.5,
        })
        pos += 1/l;
        i++;
    });

    if(l>1){
        x = Math.floor(Math.sqrt(l));
        layout = {
            annotations: annots,
            title: "Cliquez pour saisir le titre",
            grid: (l>3)? {
                rows: l,
                columns: 1,
            }:{
                rows: 1,
                columns: l,
            },
        };
    }else{
        layout = {annotations: annots, title: "Cliquez pour saisir le titre",};
    }

    Plotly.newPlot('tester', data, layout, { editable: true });
}
plot();
function loadData() {
    var qry = new XMLHttpRequest(),
        csrf = document.querySelector("meta[name='csrf-token']"),
        form = document.getElementById("form_param"),
        formd = new FormData(form);
    qry.open('POST', "http://localhost:8000/camamber");
    qry.setRequestHeader('X-CSRF-TOKEN', csrf.getAttribute('content'));
    qry.onreadystatechange = function () {
        if (qry.readyState == qry.DONE && qry.status == 200) {
            //alert(qry.response);
            var data = JSON.parse(qry.response);
            plot(data['x'],data['y'],data['yName']);
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