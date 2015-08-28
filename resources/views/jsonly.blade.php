<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Algolia</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="results">
                <article v-repeat="user: users">
                    <h2>@{{ user.name }}</h2>
                    <h4>@{{ user.company }}</h4>
                </article>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/0.12.12/vue.min.js"></script>
<script src="//cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>

<script>
    new Vue({
        el: 'body',

        data: { users: [] },

        ready: function() {
            var client = algoliasearch("02T94JSIW0", "d866daeab49969b88ab26e562503ac08");
            var index = client.initIndex('test_drive_contacts');

            index.search('Kevin', function(error, results) {
                this.users = results.hits;
            }.bind(this));
        }
    });
</script>
</body>
</html>