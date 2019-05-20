function updateProduct(id, number) { //Modify a existing product
    //Display modal with product infos
    const modifBarcode = document.getElementById('modifBarcode');
    const modifQuantity = document.getElementById('modifQuantity');
    const modifDLC = document.getElementById('modifDLC');
    const modifNStock = document.getElementById('modifNStock');
    const productId = document.getElementById('productId');

    const product = document.getElementById(number);
    const productInfos = product.childNodes;

    modifBarcode.value = productInfos[0].textContent;
    modifQuantity.value = productInfos[3].innerHTML;
    modifDLC.value = productInfos[4].innerHTML;
    modifNStock.value = productInfos[5].innerHTML;
    productId.value = id;

    console.log(product.childNodes);

}

function deleteProduct(id, number) {
    sendRequestProduct(id, 'delete');
    hide(document.getElementById(number));
}

function sendRequestProduct(id, type) {
    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState === 4) {
            console.log(request.responseText);//Réponse à afficher
        }
    };
    request.open('POST', 'updateProduct.php');
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send(`type=${type}&id=${id}`);
}

function hide(element) {
    element.style.display = 'none';
}

document.getElementById('add_product').addEventListener('submit', function (e) {
    e.preventDefault();
    const barcode = document.getElementById('inputBarcode');
    const quantity = document.getElementById('inputQuantity');
    const DLC = document.getElementById('inputDLC');
    const stock = document.getElementById('inputNStock');

    const barcodeError = document.getElementById('barcodeError');
    const quantityError = document.getElementById('quantityError');
    const stockError = document.getElementById('stockError');

    let check = true;


    if (barcode.value.length !== 14) {
        barcodeError.style.display = "block";
        check = false;
    }

    if (quantity.value > 0 && quantity.value <= 50) {

    } else {
        quantityError.style.display = "block";
        check = false;
    }

    if (stock.value >= 0 && stock.value <= 10) {

    } else {
        stockError.style.display = "block";
        check = false;
    }


    if (check === true) {
        const request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState === 4) {
                const form = document.getElementById('add_product');
                const container = document.getElementById('modal-body');

                const alert = document.createElement("p");
                alert.innerHTML = request.responseText;
                container.appendChild(alert);

                form.style.display = "none";

            }
        };
        request.open('POST', '../backoffice/stock/addProduct.php');
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.send(`barcode=${barcode.value}&quantity=${quantity.value}&DLC=${DLC.value}&stock=${stock.value}`);
    }

});

document.getElementById('update_product').addEventListener('submit', function (e) {
    e.preventDefault();
    const barcode = document.getElementById('modifBarcode');
    const quantity = document.getElementById('modifQuantity');
    const DLC = document.getElementById('modifDLC');
    const stock = document.getElementById('modifNStock');
    const productId = document.getElementById('productId');

    const barcodeError = document.getElementById('barcodeError');
    const quantityError = document.getElementById('quantityError');
    const stockError = document.getElementById('stockError');

    let check = true;


    if (barcode.value.length !== 14) {
        barcodeError.style.display = "block";
        check = false;
    }

    if (quantity.value > 0 && quantity.value <= 50) {

    } else {
        quantityError.style.display = "block";
        check = false;
    }

    if (stock.value >= 0 && stock.value <= 10) {

    } else {
        stockError.style.display = "block";
        check = false;
    }

    if (check === true) {
        const request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState === 4) {
                const form = document.getElementById('update_product');
                const container = document.getElementById('modal-body');

                const alert = document.createElement("p");
                alert.innerHTML = request.responseText;
                container.appendChild(alert);

                form.style.display = "none";
            }
        };
        request.open('POST', '../backoffice/stock/updateProduct.php');
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.send(`barcode=${barcode.value}&quantity=${quantity.value}&DLC=${DLC.value}&stock=${stock.value}&id=${productId.value}&type=update`);
    }

});

function reloadModal() { //Réaffiche le modal propre pour ajouter un nouveau produit
    const form = document.getElementById('add_product');
    form.style.display = "block";

    const barcode = document.getElementById('inputBarcode');
    const quantity = document.getElementById('inputQuantity');
    const DLC = document.getElementById('inputDLC');
    const stock = document.getElementById('inputNStock');

    barcode.value = "";
    quantity.value = "";
    DLC.value = "";
    stock.value = "";

}