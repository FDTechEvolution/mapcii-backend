<!-- DataTables -->

<?= $this->Html->css('/assets/plugins/datatables/dataTables.bootstrap4.min.css') ?>
<?= $this->Html->css('/assets/plugins/datatables/buttons.bootstrap4.min.css') ?>
<!-- Responsive datatable examples -->
<?= $this->Html->css('/assets/plugins/datatables/responsive.bootstrap4.min.css') ?>


<!-- Required datatable js -->

<?= $this->Html->script('/assets/plugins/datatables/jquery.dataTables.min.js'); ?>
<?= $this->Html->script('/assets/plugins/datatables/dataTables.bootstrap4.min.js'); ?>
<!-- Buttons examples -->
<?= $this->Html->script('/assets/plugins/datatables/dataTables.buttons.min.js'); ?>
<?= $this->Html->script('/assets/plugins/datatables/buttons.bootstrap4.min.js'); ?>
<?= $this->Html->script('/assets/plugins/datatables/jszip.min.js'); ?>
<?= $this->Html->script('/assets/plugins/datatables/pdfmake.min.js'); ?>
<?= $this->Html->script('/assets/plugins/datatables/vfs_fonts.js'); ?>
<?= $this->Html->script('/assets/plugins/datatables/buttons.html5.min.js'); ?>
<?= $this->Html->script('/assets/plugins/datatables/buttons.print.min.js'); ?>
<?= $this->Html->script('/assets/plugins/datatables/buttons.colVis.min.js'); ?>

<!-- Responsive examples -->

<?= $this->Html->script('/assets/plugins/datatables/dataTables.responsive.min.js'); ?>
<?= $this->Html->script('/assets/plugins/datatables/responsive.bootstrap4.min.js'); ?>


<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').DataTable({
            "lengthChange": true
        });


    });

</script>
