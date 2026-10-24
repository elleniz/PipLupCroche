<?php $__env->startSection('titulo', 'Formulário de Itens de Compra'); ?>

<?php $__env->startSection('conteudo'); ?>

<div class="container-fluid"
     style="background-color: #fffaf6;
            min-height: 100%;
            padding: 35px 40px;">

    <?php
        $data = $data ?? null;

        $action = !empty($data->id)
            ? route('item_compra.update', $data->id)
            : route('item_compra.store');

        $materiaisSelecionados = old(
            'materiais',
            !empty($data->id) ? [$data->material_id] : ['']
        );

        $quantidadesSelecionadas = old(
            'quantidades',
            !empty($data->id) ? [$data->quantidade] : [1]
        );
    ?>

    

    <div style="text-align: center; margin-bottom: 20px;">

        <h4 style="color: #6d3f36;
                   font-family: Georgia, serif;
                   font-weight: bold;
                   margin-bottom: 8px;">
            <?php echo e(!empty($data->id) ? 'ATUALIZAR ITEM DE COMPRA' : 'CADASTRAR ITENS DE COMPRA'); ?>

        </h4>

        <p style="color: #555; font-size: 13px; margin-bottom: 0;">
            Selecione a compra, os materiais e as respectivas quantidades.
        </p>

    </div>

    <form action="<?php echo e($action); ?>" method="POST">

        <?php echo csrf_field(); ?>

        <?php if(!empty($data->id)): ?>
            <?php echo method_field('PUT'); ?>
        <?php endif; ?>

        

        <div class="p-4"
             style="background-color: #fff;
                    border: 1px solid #ddd;
                    border-radius: 6px;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.12);
                    max-width: 650px;
                    width: 100%;
                    margin: 0 auto;">

            <div class="mb-3">

                <label for="compra_id"
                       class="form-label"
                       style="color: #555; font-size: 13px; font-weight: 500;">
                    Compra
                </label>

                <select name="compra_id"
                        id="compra_id"
                        class="form-select"
                        required
                        style="font-size: 13px; height: 40px;">

                    <option value="">Selecione uma compra</option>

                    <?php $__currentLoopData = $compras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $compra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <option value="<?php echo e($compra->id); ?>"
                            <?php echo e(old('compra_id', $data->compra_id ?? '') == $compra->id ? 'selected' : ''); ?>>

                            Compra #<?php echo e($compra->id); ?>

                            - <?php echo e($compra->fornecedor); ?>

                            - <?php echo e(\Illuminate\Support\Carbon::parse($compra->data_compra)->format('d/m/Y')); ?>


                        </option>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </select>

                <?php $__errorArgs = ['compra_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger small"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            </div>

        </div>

        

        <div style="text-align: center; margin-bottom: 20px;">

            <h4 style="color: #6d3f36;
                       font-family: Georgia, serif;
                       font-weight: bold;
                       margin-bottom: 8px;
                       margin-top: 30px;">
                MATERIAIS DA COMPRA
            </h4>

            <p style="color: #555; font-size: 13px; margin-bottom: 0;">
                Adicione os materiais que fazem parte desta compra.
            </p>

        </div>

        

        <div class="p-4 mt-4"
             style="background-color: #fff;
                    border: 1px solid #ddd;
                    border-radius: 6px;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.12);
                    max-width: 650px;
                    width: 100%;
                    margin: 0 auto;">

            <div id="itens">

                <?php $__currentLoopData = $materiaisSelecionados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $indice => $materialSelecionado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="item row mb-3 align-items-end">

                        <div class="col-7">

                            <label class="form-label" style="font-size: 13px;">
                                Material
                            </label>

                            <select name="materiais[]"
                                    class="form-select"
                                    required
                                    style="font-size: 13px;">

                                <option value="">Selecione um material</option>

                                <?php $__currentLoopData = $materiais; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <option value="<?php echo e($material->id); ?>"
                                        <?php echo e($materialSelecionado == $material->id ? 'selected' : ''); ?>>

                                        <?php echo e($material->nome_material); ?>

                                        - R$ <?php echo e(number_format($material->valor_unitario, 2, ',', '.')); ?>


                                    </option>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>

                        </div>

                        <div class="col-2">

                            <label class="form-label" style="font-size: 13px;">
                                Quantidade
                            </label>

                            <input type="number"
                                   name="quantidades[]"
                                   class="form-control"
                                   min="1"
                                   step="1"
                                   required
                                   value="<?php echo e($quantidadesSelecionadas[$indice] ?? 1); ?>"
                                   style="font-size: 13px;">

                        </div>

                        <div class="col-3">

                            <button type="button"
                                    class="btn"
                                    onclick="removerItem(this)"
                                    style="background-color: transparent;
                                           border: 1px solid #c90045;
                                           border-radius: 20px;
                                           color: #c90045;
                                           padding: 8px 10px;
                                           font-size: 11px;
                                           width: 100%;">
                                - Remover
                            </button>

                        </div>

                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

            <button type="button"
                    class="btn btn-sm mb-3"
                    onclick="adicionarItem()"
                    style="background-color: #e88da5;
                           color: #FFFFFF;
                           font-size: 13px;
                           border: none;
                           border-radius: 20px;
                           padding: 8px 16px;">
                + Adicionar material
            </button>

            <?php $__errorArgs = ['materiais'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger small"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <?php $__errorArgs = ['quantidades'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger small"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <?php $__currentLoopData = $errors->get('materiais.*'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mensagens): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $mensagens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mensagem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="text-danger small"><?php echo e($mensagem); ?></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php $__currentLoopData = $errors->get('quantidades.*'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mensagens): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $mensagens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mensagem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="text-danger small"><?php echo e($mensagem); ?></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            

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

                <a href="<?php echo e(route('item_compra.list')); ?>"
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

        </div>

    </form>

</div>

<script>
    function adicionarItem() {
        const itens = document.getElementById('itens');
        const primeiro = itens.querySelector('.item');
        const novo = primeiro.cloneNode(true);

        novo.querySelector('select').value = '';
        novo.querySelector('input').value = 1;

        itens.appendChild(novo);
    }

    function removerItem(botao) {
        const itens = document.getElementById('itens');

        if (itens.querySelectorAll('.item').length > 1) {
            botao.closest('.item').remove();
        }
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ellen\Desktop\PriplupCroche\resources\views/item_compra/form.blade.php ENDPATH**/ ?>