// VALIDATION DES CHAMPS DE FORMULAIRE DE CREATION DE CATEGORIES

function checkFormAddCategory() {
    let addForm = document.getElementById('category-add-form');
    addForm.addEventListener('submit', function (evenement) {
        let nameField = document.getElementById('name');
        let subtitleField = document.getElementById('subtitle');
        let pictureField = document.getElementById('picture');
        let errorsName = document.getElementById('errorname');
        let errorsSubtitle = document.getElementById('errorsubtitle');
        let errorsPicture = document.getElementById('errorpicture');

        if (nameField.value.length < 3) {
            errorsName.innerHTML = '<p class="errors">' + 'doit contenir au moins 3 caractères' + '</p>';
            evenement.preventDefault();
            return false;
        }

        if (subtitleField.value.length < 5) {
            errorsSubtitle.innerHTML += '<p class="errors">' + 'doit contenir au moins 5 caractères' + '</p>';
            evenement.preventDefault();
            return false;
        }

        if (!pictureField.value.startsWith("http://") || !pictureField.value.startsWith("https://")) {
            errorsPicture.innerHTML += '<p class="errors">' + 'doit commencer par http:// ou https://' + '</p>';
            evenement.preventDefault();
            return false;
        }
    })
}

// VERIFICATION DES DOUBLONS DANS LA PAGE DE SELECTION DES CATEGORIES DE PRODUITS SUR LA HOME

function checkDoubleHomeCategories(event) {
    //cible tous les <select> du form
    var allSelect = document.querySelectorAll("#home-edit-form select");

    //fonction qui est appelée quand on change la valeur d'un select

    for (var i = 0; i < allSelect.length; i++) {
        allSelect[i].style.borderColor = "#ced4da";
    }

    for (var i = 0; i < allSelect.length; i++) {

        for (var k = 0; k < allSelect.length; k++) {
            if (allSelect[i].value === allSelect[k].value && i !== k) {
                allSelect[i].style.borderColor = "#F0F";
                allSelect[k].style.borderColor = "#F0F";

            }
        }
    }
}

//met tous les select sous écoute de l'événement "change"
for (var i = 0; i < allSelect.length; i++) {
    allSelect[i].addEventListener("change", checkDoubleHomeCategories);
}

// VERIFICATION DES DOUBLONS DANS LA PAGE DE SELECTION DES TYPES DE PRODUITS DU FOOTER

function checkDoubleFooterTypes(event) {
    var allFooterSelect = document.querySelectorAll("#footer-edit-form");
    
    for (var i = 0; i < allFooterSelect.length; i++) {
        allFooterSelect[i].style.borderColor = "#ced4da";
    }

    for (var i = 0; i < allFooterSelect.length; i++) {
        for (var j = 0; j < allFooterSelect.length; j++) {
            if (allFooterSelect[i].value === allFooterSelect[j].value && i !== j) {
                allFooterSelect[i].style.borderColor = "red";
                allFooterSelect[j].style.borderColor = "red";
            }
        }
    }

    for (var i = 0; i < allFooterSelect.length; i++) {
        allFooterSelect[i].addEventListener("change", checkDoubleFooterTypes);
    }
}