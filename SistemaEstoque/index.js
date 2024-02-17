function editar(id, txt_produto) {
    //criar um form de edição
    let form = document.createElement('form')
    form.action = 'produto_controller.php?acao=atualizar'
    form.method = 'post'
    form.className = 'row'
    console.log(id)

    //criar um input para entrada do texto
    let inputProduto = document.createElement('input')
    inputProduto.type = 'text'
    inputProduto.name = 'produto'
    inputProduto.className = 'col-9 form-control'
    inputProduto.value = txt_produto

    //criar um input hidden para guardar o id da tarefa
    let inputId = document.createElement('input')
    inputId.type = 'hidden'
    inputId.name = 'id_produto'
    inputId.value = id

    //criar um button para envio do form
    let button = document.createElement('button')
    button.type = 'submit'
    button.className = 'col-3 btn btn-info'
    button.innerHTML = 'Atualizar'

    //incluir inputTarefa no form
    form.appendChild(inputProduto)

    //incluir inputId no form
    form.appendChild(inputId)

    //incluir button no form
    form.appendChild(button)

    //teste
    console.log(form)

    //selecionar a div tarefa
    let produto = document.getElementById('produto_'+id)

    //limpar o texto da tarefa para inclusão do form
    produto.innerHTML = ''

    //incluir form na página
    produto.insertBefore(form, produto[0])
    
}

function remover(id) {
    location.href = 'todos_produtos.php?acao=remover&id='+id
}

function marcarRealizada(id) {
    location.href = 'todos_produtos.php?acao=marcarRealizada&id='+id
}