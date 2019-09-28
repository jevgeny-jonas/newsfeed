
$(document).ready(function () {
    var url = '/api/news';
    var maxCount = 5;

    $.ajax(url, {
        accepts: {
            xml: 'application/rss+xml'
        },
        method: 'GET',
        dataType: 'xml',
        success: function (data) {
            var newsBlock = $('#news-feed').empty();
            var count = 0;
            
            $(data).find('item').each(function () {
                if (count >= maxCount) {
                    return;
                }
                                
                var $this = $(this);
                var xmlTitle = $this.find('title');
                var xmlDesc = $this.find('description');
                var xmlLink = $this.find('link');
                var itemWrapper = $('<div class="news-item-wrapper"></div>');
                var item = $('<div></div>');
                
                //https://validator.w3.org/feed/docs/rss2.html
                //All elements of an item are optional, however at least one of title or description must be present.
                if (xmlTitle.length !== 0 && xmlTitle.text() !== '') {
                    item.append($('<h3></h3>').text(xmlTitle.text()));
                }
                if (xmlDesc.length !== 0 && xmlDesc.text() !== '') {
                    item.append($('<p></p>').text(xmlDesc.text()));
                }
                if (xmlLink.length !== 0 && xmlLink.text() !== '') {
                    var link = $('<a></a>')
                               .attr('href', xmlLink.text())
                               .attr('target', '_blank')
                               .attr('rel', 'noopener')
                               .append(item);
                    item = link;
                }
                
                newsBlock.append(itemWrapper.append(item));
                count++;
            });
        }
    });
});
