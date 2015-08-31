<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Algolia</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha/css/bootstrap.min.css">
    <style>
        body {
            margin: auto;
            padding-top: 40px;
            font-family: sans-serif;
            font-size: 17px;
        }
        em {
            background: #eceff1;
        }

        h2, h3, h4 {
            margin: 0;
        }

        input.form-control {
            width: 500px;
            height: 50px;
            font-size: 32px;
line-height: 42px;
            vertical-align: middle;
            border: 1px solid #eceff1;
            padding: 4px 10px;
        }

        .tt-menu {
            border: 1px solid #eceff1;
            text-align: left;
            position: relative;
            width: 100%;
            z-index: 50;
        }

        .tt-suggestion {
            padding: 20px 10px;
            background: white;
            border-bottom: 1px solid #eceff1;
        }

        .tt-cursor {
            background: #eceff1;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <form>
                <fieldset class="form-group">
                    <input type="text" id="query" name="query" v-on="keyup: search | key 'enter'" v-model="query" class="form-control input-lg">
                </fieldset>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="results">
                <article v-repeat="post: posts">
                    <h2 v-html="post._highlightResult.title.value"></h2>
                    <h4 v-html="post._highlightResult.published_at.value"></h4>
                </article>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/0.12.12/vue.min.js"></script>
<script src="//cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.jquery.min.js"></script>

<script>
    new Vue({
        el: 'body',

        data: {
            query: '',
            posts: []
        },

        ready: function() {
            this.client = algoliasearch("02T94JSIW0", "d866daeab49969b88ab26e562503ac08");
            this.index = this.client.initIndex('posts');

            $('#query')
                .typeahead(null, {
                    source: this.index.ttAdapter(),
                    displayKey: 'title',
                    templates: {
                        suggestion: function(hit) {
                            return (
                                '<div>' +
                                '<h3 class="title">' + hit._highlightResult.title.value + '</h3>' +
                                '<h4 class="published_at">' + hit._highlightResult.published_at.value + '</h4>' +
                                '</div>'
                            );
                        }
                    }
            })
                .on('typeahead:select', function(e, suggestion) {
                   this.query = suggestion.email;
                }.bind(this));
        },

        methods: {
            search: function () {
                this.$log('query');
//                if ( this.query.length < 3 ) return;

                this.index.search(this.query, function (error, results) {
                    this.posts = results.hits;
                }.bind(this));
            }
        }
    });
</script>
</body>
</html>