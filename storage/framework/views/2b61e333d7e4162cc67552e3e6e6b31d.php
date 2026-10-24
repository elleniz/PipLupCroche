<?php $__env->startSection('titulo', 'Formulário de Compras'); ?>

<?php $__env->startSection('conteudo'); ?>

<div class="container-fluid"
     style="background-color: #fffaf6;
            min-height: 100%;
            padding: 35px 40px;">

    <?php
        $data = $data ?? null;

        $action = !empty($data->id)
            ? route('compras.update', $data->id)
            : route('compras.store');

        $materiaisSelecionados = old(
            'materiais',
            isset($data->materiais)
                ? $data->materiais->pluck('id')->toArray()
                : ['']
        );

        $quantidadesSelecionadas = old(
            'quantidades',
            isset($data->materiais)
                ? $data->materiais->pluck('pivot.quantidade')->toArray()
                : [1]
        );
    ?>


    <div style="text-align: center; margin-bottom: 20px;">

        <h4 style="color: #6d3f36;
                   font-family: Georgia, serif;
                   font-weight: bold;
                   margin-bottom: 8px;">
            <?php echo e(!empty($data->id) ? 'EDITAR COMPRA' : 'CADASTRAR COMPRA'); ?>

        </h4>

        <p style="color: #555; font-size: 13px; margin-bottom: 0;">
            Cadastre ou atualize uma compra
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

                <label for="fornecedor"
                       class="form-label"
                       style="color: #555; font-size: 13px; font-weight: 500;">
                    Fornecedor
                </label>

                <input type="text"
                       name="fornecedor"
                       id="fornecedor"
                       class="form-control"
                       required
                       style="font-size: 13px; height: 40px;"
                       value="<?php echo e(old('fornecedor', $data->fornecedor ?? '')); ?>">

                <?php $__errorArgs = ['fornecedor'];
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


            <div class="mb-3">

                <label for="data_compra"
                       class="form-label"
                       style="color: #555; font-size: 13px; font-weight: 500;">
                    Data da compra
                </label>

                <input type="date"
                       name="data_compra"
                       id="data_compra"
                       class="form-control"
                       required
                       style="font-size: 13px; height: 40px;"
                       value="<?php echo e(old('data_compra', isset($data->data_compra) && $data->data_compra ? \Illuminate\Support\Carbon::parse($data->data_compra)->format('Y-m-d') : '')); ?>">

                <?php $__errorArgs = ['data_compra'];
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
                ADICIONAR MATERIAIS À COMPRA
            </h4>

            <p style="color: #555; font-size: 13px; margin-bottom: 0;">
                Adicione os materiais e informe as quantidades desejadas.
                O valor total será calculado automaticamente.
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

                            <label class="form-label"
                                   style="font-size: 13px;">
                                Material
                            </label>

                            <select name="materiais[]"
                                    class="form-select material-select"
                                    required
                                    style="font-size: 13px;"
                                    onchange="calcularTotal()">

                                <option value="">Selecione um material</option>

                                <?php $__currentLoopData = $materiais; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <option value="<?php echo e($material->id); ?>"
                                            data-valor="<?php echo e($material->valor_unitario); ?>"
                                            <?php echo e($materialSelecionado == $material->id ? 'selected' : ''); ?>>

                                        <?php echo e($material->nome_material); ?>

                                        - R$ <?php echo e(number_format($material->valor_unitario, 2, ',', '.')); ?>


                                    </option>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>

                        </div>


                        <div class="col-2">

                            <label class="form-label"
                                   style="font-size: 13px;">
                                Quantidade
                            </label>

                            <input type="number"
                                   name="quantidades[]"
                                   class="form-control quantidade-material"
                                   min="1"
                                   required
                                   value="<?php echo e($quantidadesSelecionadas[$indice] ?? 1); ?>"
                                   style="font-size: 13px;"
                                   oninput="calcularTotal()">

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
                                Remover material
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
                Adicionar novo material
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


            <div class="mb-3 mt-4">

                <label for="valor_total"
                       class="form-label"
                       style="color: #555; font-size: 13px; font-weight: 500;">
                    Valor total da compra
                </label>

                <input type="text"
                       id="valor_total"
                       class="form-control"
                       value="R$ 0,00"
                       readonly
                       style="font-size: 13px;
                              height: 40px;
                              background-color: #faf9f900;">

            </div>

            <p style="font-size: 12px; color: #666;">
                O valor total será calculado com base nos materiais
                selecionados e nas quantidades informadas.
            </p>


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

                <a href="<?php echo e(route('compras.index')); ?>"
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

<!--js-->
<script>
    function adicionarItem() {
        //
        const itens = document.getElementById('itens');//pega classe item
        const primeiro = itens.querySelector('.item');
        const novo = primeiro.cloneNode(true);

        novo.querySelector('select').value = '';//p poder escol her outro
        novo.querySelector('input').value = 1;

        itens.appendChild(novo);

        calcularTotal();
    }

    function removerItem(botao) {
        const itens = document.getElementById('itens');

        if (itens.querySelectorAll('.item').length > 1) {
            botao.closest('.item').remove();
            calcularTotal();
        }
    }

    function calcularTotal() {
        let total = 0;

        document.querySelectorAll('#itens .item').forEach(function (item) {
            const select = item.querySelector('.material-select');
            const quantidadeCampo = item.querySelector('.quantidade-material');

            const opcao = select.options[select.selectedIndex];
            const valor = parseFloat(opcao.dataset.valor) || 0;
            const quantidade = parseInt(quantidadeCampo.value) || 0;

            if (quantidade > 0) {
                total += valor * quantidade;
            }
        });

        document.getElementById('valor_total').value =
            total.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });
    }

    calcularTotal();
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ellen\Desktop\PriplupCroche\resources\views/compra/form.blade.php ENDPATH**/ ?>