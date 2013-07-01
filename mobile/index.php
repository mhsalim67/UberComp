<html>  
  <head>  
    <title>UberComp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../common/bootstrap.min.css" rel="stylesheet">
    <link href="static/stylesheet.css" rel="stylesheet">  

  <!-- 1) Include the libraries -->
    <script type="text/javascript" src="../common/config.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="../common/bootstrap.min.js"></script>
    <script type="text/javascript" src="../common/jquery.thingbroker-0.3.0.js"></script>
    <script type="text/javascript" src="../common/jquery.formplugin.js"></script>
    
    <script src="static/scripts.js"></script>

  </head>  

  <body>
    <div class="container">
      <h1>File Upload</h1>
      <form class="form-horizontal" id="image-upload" enctype="multipart/form-data">
        <div class="row">
          <label class="col col-lg-2 control-label" for="file">Pick a file: </label>
          <div class="col col-lg-10">
            <input type="file" name="file" id="file" />
          </div>
        </div>

        <div class="row">
          <label class="col col-lg-2 control-label" for="image_name">Choose a name: </label>
          <div class="col col-lg-10">
            <input type="text" name="image_name" id="image_name" />
          </div>
        </div>

        <div class="row">
          <label class="col col-lg-2 control-label" for="image_comments">Have any comments: </label>
          <div class="col col-lg-10">
            <textarea name="image_comments" id="image_comments"></textarea>
          </div>
        </div>

        <div class="row">
          <div class="well col col-lg-12">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
          </div>
        </div>
      </form>
    </div>

  </body>
</html>
