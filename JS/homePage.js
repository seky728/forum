function showAddCommentBlock(id) {
    document.getElementById("addCommentBlock-" + id).style.display = "block";
}

function checkArticleNewForm() {
    let title = document.querySelector('.newsForm [name="title"]').value;
    let text = document.querySelector('.newsForm [name="text"]').value;

    let alertText = "";
    let status = true;

    if (title === "") {
        alertText += "Title musí být vyplněný \n";
        status = false;
    }

    if (text === "") {
        alertText += "Text musí být vyplněný \n";
        status = false;
    }

    alert(alertText);

    return status;

}


function checkComment(id) {
    let textField = document.querySelector("#addCommentBlock-" + id + " input").value;

    if (textField === "") {
        alert("Políčko pro komentář nesmí být prázdné");
        return false;
    }

    return true;
}