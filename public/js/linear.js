function plot(x = [], Y = [], yName, mode, forme) {
    var data = [];
    if(x.length>50){
        X = [];
        for (let i = 0; i < x.length; i=i+50) {
            X.push(x.slice(i,i+50));
        }
        i = 0;
        j = 1;
        var p = document.getElementById('v1');
        p.innerHTML = "";
        X.forEach(el => {
            var div = document.createElement('div');
            div.id = "tester"+j;
            p.appendChild(div);
            k = 0;
            Y.forEach(y => {
                y = y.slice(i,i+50);
                data.push({
                    x:el,
                    y:y,
                    name: yName[k],
                    mode: mode,
                    line: {shape: forme},
                    type: 'scatter',
                });
                k++;
            });

            var layout = { barmode: 'group', title: "Cliquez pour saisir le titre" };

            Plotly.newPlot('tester'+j, data, layout, { editable: true });
            data = [];
            i=i+50;
            j++;
        });
    }else{
        k = 0;
        Y.forEach(el => {
            data.push({
                x:x,
                y:el,
                name: yName[k],
                mode: mode,
                type: 'scatter',
            });
            k++;
        });

        var layout = { title: "Cliquez pour saisir le titre" };

        Plotly.newPlot('tester', data, layout, { editable: true });
    }
}
plot();
function loadData() {
    var qry = new XMLHttpRequest(),
        csrf = document.querySelector("meta[name='csrf-token']"),
        hote = document.querySelector("input[name='hote']"),
        form = document.getElementById("form_param"),
        formd = new FormData(form);
    qry.open('POST', hote.value + "/courbes");
    qry.setRequestHeader('X-CSRF-TOKEN',csrf.getAttribute('content'));
    qry.onreadystatechange = function(){
        if(qry.readyState == qry.DONE && qry.status == 200){
            //alert(qry.response);
            var data = JSON.parse(qry.response);
            plot(data['x'],data['y'],data['yName'],data['mode'],data['forme']);
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