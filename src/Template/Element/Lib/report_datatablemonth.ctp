
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<?= $this->Html->script('/datatable/pdf/pdfmake.min.js'); ?>
<?= $this->Html->script('/datatable/pdf/vfs_fonts.js'); ?>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
//        function getBase64FromImageUrl(url) {
//            var img = new Image();
//            img.crossOrigin = "anonymous";
//            img.onload = function () {
//                var canvas = document.createElement("canvas");
//                canvas.width = this.width;
//                canvas.height = this.height;
//                var ctx = canvas.getContext("2d");
//                ctx.drawImage(this, 0, 0);
//                var dataURL = canvas.toDataURL("image/png");
//                return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
//            };
//            img.src = url;
//        }

        //////////////////////////////
        $('#datatable').DataTable({
            "lengthChange": false,
            "lengthMenu": [[50, -1], [50, "All"]],
            "ordering": false
        });

        //Buttons examples
        var table = $('#datatable-buttons').DataTable({
            dom: 'Bfrtip',
            lengthChange: false,
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: 'รายงานการผลิตรายเดือน'
                },
                {
                    extend: 'pdfHtml5',
                    title: 'รายงานการผลิตรายเดือน',
                     customize: function (doc) {
                        doc.content[1].table.widths =
                                Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    },
                    orientation:'landscape'
                }
            ],
            "ordering": false,
            "searching": false,
            "pageLength": 50
        });

        table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
    });

</script>
