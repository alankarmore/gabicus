<footer>
    <div class="pull-right">
        Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
    </div>
    <div class="clearfix"></div>
</footer>
<script type="text/javascript">
    function generateTable(tableId,route,sortColumn,sortOrder)
    {
        $("#"+tableId).bootstrapTable({
            url:route,
            contentType: 'application/x-www-form-urlencoded',
            queryParams: function (p) {
                return {
                 limit: p.limit,
                 offset: p.offset,
                 search: (p.search)?p.search:"",
                 sort: p.sort,
                 order: p.order
             };
            },
            method:'post',
            pagination:true,
            sidePagination:'server',
            search:true,
            sortName:sortColumn,
            sortOrder:sortOrder,
            cache:false,
            pageSize:10,
        });
    }
</script>