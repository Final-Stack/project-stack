let addtag = document.getElementById('add_tag');
let tag_container = document.getElementById('tag_container');
let tag_block = '';
let tag_block_container = document.getElementById('tag_block');

addtag.addEventListener("click", function(){
    let tag = document.getElementById('tag').value;
    let p = document.createElement("p");
    let texto = document.createTextNode(tag);
    p.appendChild(texto);
    tag_container.appendChild(p);
    if(tag_block ==''){
        tag_block = tag;
    }else{
        tag_block = tag_block  + ',' + tag;
    }
    tag_block_container.value = tag_block;

});

