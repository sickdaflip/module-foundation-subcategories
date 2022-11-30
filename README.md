#### add custom cms block

Categories -> categories

    {{block class="Flipdev\Subcategories\Block\Subcategories" name="Subcategories" template="Flipdev_Subcategories::subcategories.phtml"}}

for show categories banner in a category by select in Display Setting show static block only and add cms block categories


#### add widget block
work in all pages, by selected parent category id

    {{widget type="Flipdev\Subcategories\Block\Widget\SubcategoriesWidget" image="image" imagewidth="250" imageheight="250" parentcat="2"}}
