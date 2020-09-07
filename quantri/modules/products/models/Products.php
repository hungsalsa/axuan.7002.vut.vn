<?php

namespace quantri\modules\products\models;

use Yii;
use yii\helpers\ArrayHelper;


class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pro_name', 'slug', 'product_category_id', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'required','message'=>'{attribute} không được để trống'],
            [['inventory', 'amount','price', 'price_sales', 'product_type_id', 'supplier_id', 'warranty_period', 'models_id', 'views', 'product_category_id', 'status', 'time_status', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'integer'],
            [['keywords', 'descriptions', 'short_introduction', 'content', 'tab2', 'tab3'], 'string'],
            [['start_sale', 'end_sale', 'image','vat', 'order_out_stock', 'highlights', 'related_articles', 'related_products','related_albums', 'related_downloads'], 'safe'],
            [['order'], 'number'],
            [['code'], 'string', 'max' => 50],
            [['pro_name','pro_name_not', 'title', 'slug', 'images_list'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['tags'], 'safe'],
            // [['code'], 'unique'],
            [['pro_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'pro_name' => 'Pro Name',
            'pro_name_not' => 'pro_name_not',
            'inventory' => 'Quản lý kho',
            'amount' => 'Số lượng (đầu)',
            'order_out_stock' => 'Cho phép tiếp tục đặt hàng khi hết hàng',

            'supplier_id' => 'Nhà cung cấp',
            'warranty_period' => 'Warranty Period',
            'highlights' => 'Nổi bật',
            'views' => 'Views',
            'image' => 'Image',
            'images_list' => 'Images List',
            'tags' => 'Tags',
            'vat' => 'Giá đã bao gồm VAT',
            'time_status' => 'Đặt lịch hiển thị',

            'pro_name' => 'Tên sản phẩm',
            'title' => 'Title',
            'slug' => 'Đường dẫn',
            'keyword' => 'Keywords',
            'descriptions' => 'Description',
            'short_introduction' => 'Mô tả ngắn',
            'content' => 'Chi tiết',
            'tab2' => 'tab2',
            'tab3' => 'tab3',
            'price' => 'Giá bán',
            'price_sales' => 'Khuyến mại',
            'start_sale' => 'Ngày bắt đầu',
            'end_sale' => 'Ngày kết thúc',
            'order' => 'Sắp xếp',
            'status' => 'Trạng thái',
            'product_type_id' => 'Loại sản phẩm',
            'salse' => 'Giảm giá',
            'hot' => 'Nổi bật',
            'best_seller' => 'Bán chạy',
            'guarantee' => 'Bảo hành',
            'models_id' => 'Xe sử dụng',
            'views' => 'Lượt xem',
            'code' => 'Mã sản phẩm',
            'image' => 'Ảnh đại diện',
            'images_list' => 'Images List',
            'tags' => 'Tags',
            'product_category_id' => 'Danh mục',
            'related_articles' => 'Bài viết liên quan',
            'related_products' => 'Sản phẩm liên quan',
            'related_albums' => 'Albums liên quan',
            'related_downloads' => 'Files liên quan',
            'userCreated' => 'User ID',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'userCreated' => 'Người tạo',
            'userUpdated' => 'Người sửa',
        ];
    }

    public function getProductCategory()
    {
        return $this->hasOne(Productcategory::className(),['idCate'=>'product_category_id']);
    }

    public function getListimages()
    {
        return $this->hasMany(ProductImages::className(),['pro_id'=>'id']);
    }


    public function getVersions()
    {
        return $this->hasMany(ProductVersions::className(),['pro_id'=>'id'])->orderBy(['date'=>SORT_ASC]);

        // return $this->hasMany(Prices::className(), ['device_id' => 'id'])->
      // orderBy(['device_price' => SORT_DESC]);

    }

    public function getThuoctinh()
    {
        return $this->hasMany(ProductThuoctinh::className(),['product_id'=>'id']);
    }

    public function getAlltags()
    {
        return $this->hasMany(\quantri\models\Tags::className(),['link'=>'id'])->andOnCondition(['type' => 'product']);;
    }

    public function getOrderDetail()
    {
        return $this->hasMany(OrderDetail::className(),['pro_id'=>'id']);
                // ->viaTable('tbl_order', ['tbl_order_detail.order_id'=>'tbl_order.order_id']);;
    }

    public function getProname()
    {
        return $this->pro_name;
                // ->viaTable('tbl_order', ['tbl_order_detail.order_id'=>'tbl_order.order_id']);;
    }

    public function getAllProducts()
    {
        return ArrayHelper::map(self::find()->where('status =:status',['status'=>1])->orderBy(['pro_name'=>SORT_DESC])->all(),'id','pro_name');
    }

    // Hàm lấy danh sách IDcate có sử dụng
    public function getAllIdCategory()
    {
        return  yii\helpers\ArrayHelper::map(self::find()->select(['product_category_id'])->distinct()->where('status=:status',[':status'=>true])->all(),'product_category_id','product_category_id');
    }
}