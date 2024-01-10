<!DOCTYPE html>
<html>
    <head>
        <title>Viewstl Javascript Plugin - Simple Example</title>
    </head>

    <body>
        <div id="stl_cont" style="width:500px;height:500px;margin:0 auto;"></div>

        <script src="stl_viewer.min.js"></script>        
        <script>
            var stl_viewer=new StlViewer
            (
                document.getElementById("stl_cont"),
                {
                    models:
                    [
                        {filename:"mystl.STL"}
                    ]
                }
            );
        </script>
        
    </body>
</html>