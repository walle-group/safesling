function option(name, key){
    let result = document.createElement('option');
    result.setAttribute('value', key);
    result.innerHTML = name;
    
    return name;
}

function addelement(){
    let i = parseInt($("#keycount").val()) + 1;
    
    let element = `<div class="element" id="e`+i+`">
                <input type="text" name="key`+i+`" required>
                <select name="keytype`+i+`">
                    <option value="string" selected>Satr</option>
                    <option value="integer">Son</option>
                    <option value="boolean">Mantiqiy</option>
                </select>
                <input type="text" name="keyinfo`+i+`" required>
            </div>`;
    
    $("#docelements").append(element);
    $("#keycount").val(i);
}

function deleteend(){
    let i = parseInt($("#keycount").val());
    if (i > 1){
        $("#e"+i).remove();
        i--;
        $("#keycount").val(i);
    }
}

function adddoc(){ document.getElementById('adddoc').style.display = 'block';
}
