<html>
<body>

    <h3 class="page-title">Import Companies</h3>

    <form id="formSubmit" action="{{URL::to('importCompanies')}}" method="post" enctype="multipart/form-data" role="form" >
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <input type="file" name="file" class="filestyle" data-buttonName="btn-warning" required="" data-buttonBefore="true"><br/><br/>
        <button type="submit">Submit</button>
    </form>

</body>
</html>

