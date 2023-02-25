function addLabel(){
    var i = document.getElementsByClassName("texts").length;

    var text = "text" + (i+1).toString();
    var file = "file" + (i+1).toString();


    var formular = document.getElementById("formular");


    /*var added = '<br><label class="texts"><b>Introduceti textul</b></label>' +
        '<input type="text" placeholder="Introduceti textul" name="' + text +'">' +

        '<label><b>Introduceti imaginea</b></label><br>' +
        '<input type="file" name="' + file + '">';

    formular.appendChild(added);*/

    var newline = document.createElement("br");
    var label = document.createElement("label");
    label.className = "texts";
    var b = document.createElement("b");
    b.textContent = "Introduceti textul";
    label.appendChild(b);

    formular.appendChild(newline);

    formular.appendChild(label);

    var input = document.createElement("input");
    input.type = "text";
    input.placeholder = "Introduceti textul";
    input.name = text;

    formular.appendChild(input);

    label = document.createElement("label");
    var b2 = document.createElement("b");
    b2.textContent = "Introduceti imaginea sau videoclipul";
    label.appendChild(b2);
    //label.appendChild(document.createElement("b").innerHTML = "Introduceti imaginea");

    formular.appendChild(label);
    formular.appendChild(document.createElement("br"));

    input = document.createElement("input");
    input.type = "file";
    input.className = "white_text";
    input.name = file;

    formular.appendChild(input);

    /*
    formular.innerHTML = formular.innerHTML + '<br><label class="texts"><b>Introduceti textul</b></label>' +
        '<input type="text" placeholder="Introduceti textul" name="' + text +'">' +

        '<label><b>Introduceti imaginea</b></label><br>' +
        '<input type="file" name="' + file + '">';

     */
}


function show_password(){
    var x = document.getElementById("mypass");
    if(x.type === "password"){
        x.type = "text";
    } else{
        x.type = "password";
    }
}

function createCookie(name, value, days) {
    var expires;

    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }

    document.cookie = escape(name) + "=" +
        escape(value) + expires + "; path=/";
}

function classNames(){
    var identities = document.getElementsByClassName("texts").length;

    createCookie("identities",identities.toString(),"1");

}

function questionValue(questionId, choiceId){

    var choice = document.getElementById(choiceId);

    questionId.value = choice.value;

}

function checkId(buton){
    var course_id = buton.value;
    if(isNaN(course_id) || course_id<1){
        alert("Valoarea id-ului cursului trebuie sa fie intreg pozitiv!");
        return false;
    }
    else
        return true;
}