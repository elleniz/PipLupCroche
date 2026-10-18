<?php $__env->startSection('titulo', 'Formulário de Produtos'); ?>

<?php $__env->startSection('conteudo'); ?>

<div class="container-fluid"
     style="background-color: #fffaf6;
            min-height: 100%;
            padding: 35px 40px;">

<?php
    if (!empty($data->id)) {
        $action = route('produto.update', $data->id);
    } else {
        $action = route('produto.store');
    }
?>

<div style="text-align: center; margin-bottom: 20px;">

    <h4 style="color: #6d3f36;
               font-family: Georgia, serif;
               font-weight: bold;
               margin-bottom: 8px;">
        CADASTRAR PRODUTO
    </h4>

    <p style="color: #555;
              font-size: 13px;
              margin-bottom: 0;">
        Cadastre um novo produto
    </p>

</div>

<form action="<?php echo e($action); ?>"
      method="post"
      class="p-4"
      style="background-color: #fff;
             border: 1px solid #ddd;
             border-radius: 6px;
             box-shadow: 0 2px 5px rgba(0,0,0,0.12);
             max-width: 650px;
             width: 100%;
             margin: 0 auto;">

    <?php echo csrf_field(); ?>

    <?php if(!empty($data->id)): ?>
        <?php echo method_field('PUT'); ?>
    <?php endif; ?>

    <input type="hidden"
           name="id"
           value="<?php echo e(old('id', $data->id ?? '')); ?>">

    
    <div class="mb-3">

        <label for="nome"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Nome
        </label>

        <input type="text"
               name="nome"
               id="nome"
               class="form-control"
               style="border: 1px solid #ccc;
                      border-radius: 5px;
                      font-size: 13px;
                      height: 40px;
                      padding: 7px 12px;"
               value="<?php echo e(old('nome', $data->nome ?? '')); ?>">

    </div>

    
    <div class="mb-3">

        <label for="preco"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Preço
        </label>

        <input type="number"
               name="preco"
               id="preco"
               step="0.01"
               class="form-control"
               style="border: 1px solid #ccc;
                      border-radius: 5px;
                      font-size: 13px;
                      height: 40px;
                      padding: 7px 12px;"
               value="<?php echo e(old('preco', $data->preco ?? '')); ?>">

    </div>

    
    <div class="mb-3">

        <label for="quantidade"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Quantidade
        </label>

        <input type="number"
               name="quantidade"
               id="quantidade"
               class="form-control"
               style="border: 1px solid #ccc;
                      border-radius: 5px;
                      font-size: 13px;
                      height: 40px;
                      padding: 7px 12px;"
               value="<?php echo e(old('quantidade', $data->quantidade ?? '')); ?>">

    </div>

    
    <div class="mb-3">

        <label for="categoria_id"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Categoria
        </label>

        <select name="categoria_id"
                id="categoria_id"
                class="form-select"
                style="border: 1px solid #ccc;
                       border-radius: 5px;
                       font-size: 13px;
                       height: 40px;
                       padding: 7px 12px;">

            <option value="">Selecione uma categoria</option>

            <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <option value="<?php echo e($categoria->id); ?>"
                    <?php echo e(old('categoria_id', $data->categoria_id ?? '') == $categoria->id ? 'selected' : ''); ?>>

                    <?php echo e($categoria->nome); ?>


                </option>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </select>

    </div>

    
    <div class="mb-3">

        <label for="descricao"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Descrição
        </label>

        <input type="text"
               name="descricao"
               id="descricao"
               class="form-control"
               style="border: 1px solid #ccc;
                      border-radius: 5px;
                      font-size: 13px;
                      height: 40px;
                      padding: 7px 12px;"
               value="<?php echo e(old('descricao', $data->descricao ?? '')); ?>">

    </div>

    
    <div class="mb-3">

        <label for="material"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Material
        </label>

        <select name="material"
                id="material"
                class="form-select"
                style="border: 1px solid #ccc;
                       border-radius: 5px;
                       font-size: 13px;
                       height: 40px;
                       padding: 7px 12px;">

            <option value="">Selecione o material</option>

            <option value="ALGODAO"
                <?php echo e(old('material', $data->material ?? '') == 'ALGODAO' ? 'selected' : ''); ?>>
                ALGODÃO
            </option>

            <option value="ALGODAO-RECICLADO"
                <?php echo e(old('material', $data->material ?? '') == 'ALGODAO-RECICLADO' ? 'selected' : ''); ?>>
                ALGODÃO RECICLADO
            </option>

            <option value="BARBANTE"
                <?php echo e(old('material', $data->material ?? '') == 'BARBANTE' ? 'selected' : ''); ?>>
                BARBANTE
            </option>

            <option value="FIO-DE-MALHA"
                <?php echo e(old('material', $data->material ?? '') == 'FIO-DE-MALHA' ? 'selected' : ''); ?>>
                FIO DE MALHA
            </option>

            <option value="LA-NATURAL"
                <?php echo e(old('material', $data->material ?? '') == 'LA-NATURAL' ? 'selected' : ''); ?>>
                LÃ NATURAL
            </option>

            <option value="VISCOSE"
                <?php echo e(old('material', $data->material ?? '') == 'VISCOSE' ? 'selected' : ''); ?>>
                VISCOSE
            </option>

        </select>

    </div>

    
    <div class="mb-3">

        <label for="peso"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Peso
        </label>

        <input type="text"
               name="peso"
               id="peso"
               class="form-control"
               style="border: 1px solid #ccc;
                      border-radius: 5px;
                      font-size: 13px;
                      height: 40px;
                      padding: 7px 12px;"
               value="<?php echo e(old('peso', $data->peso ?? '')); ?>">

    </div>

    <label for="imagem">Imagem</label>
                <?php
                    $nome_imagem = !empty($data->imagem) ? $data->imagem : 'sem_imagem.jpg';
                ?>
                <img src="/storage/<?php echo e($nome_imagem); ?>" class="rounded-circle" width="200px" height="200px"
                    alt="Imagem" />
                <input type="file" name="imagem" class="form-control" value="<?php echo e(old('imagem', $data->imagem ?? '')); ?>">
            </div>

    
    <div class="d-flex justify-content-between mt-3">

        <button type="submit"
                class="btn"
                style="background-color: #e88da5;
                       border: none;
                       border-radius: 20px;
                       color: white;
                       padding: 8px 30px;
                       font-size: 13px;">
            Salvar
        </button>

        <a href="<?php echo e(url('produto')); ?>"
           class="btn"
           style="background-color: #c90045;
                  border: none;
                  border-radius: 20px;
                  color: white;
                  padding: 8px 30px;
                  font-size: 13px;">
            Voltar
        </a>

    </div>

</form>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ellen\Desktop\PriplupCroche\resources\views/produto/form.blade.php ENDPATH**/ ?>