![Design Patterns For Humans](https://cloud.githubusercontent.com/assets/11269635/23065273/1b7e5938-f515-11e6-8dd3-d0d58de6bb9a.png)

***

<p align="center">
🎉 Giải thích đơn giản về design patterns! 🎉
</p>
<p align="center">
Một chủ đề đễ làm cho một số người khó hiểu. Ở đây tôi cô gắng giải thích chúng theo một cách <i>đơn giản</i> làm cho bạn dễ hiểu hơn (và kể cả tôi).
</p>

***

<sub>Xem  [blog](http://kamranahmed.info) của tôi và nói "Xin chào"  [Twitter](https://twitter.com/kamranahmedse).</sub>

Giới thiệu
=================

Design patterns là những giải pháp cho những vấn đề thường gập phải; **Hướng dẫn giải quyết những vấn đề nhất định**. Nó không phải là những class, package hay những thư viện mà bạn có thể thêm vào ứng dụng của bạn và chờ đợi điều kì diệu xảy ra. Đây là những hướng dẫn về cách giải quyết các vấn đề nhất định trong những tình huống nhất định.

> Design patterns là những giải pháp cho những vấn đề thường gặp phải; hướng dẫn đẻ làm sao giải quyết một sô vấn đề

Wikipedia mổ tả chúng như là

> Trong sản xuất phần mền, design pattern của môt phần mền là một giải pháp chung có thể tái sử dụng lên một vấn đề thường xảy ra trong một bối cảnh nhất định trong thiết kế phần mềm . Nó không phải là một thiết kế đã hoàn thành nó có thẻ được chuyển đổi trực tiếp thành mã nguồn hoặc mã máý. Nó là một phần mô tả hay môt khuôn mẫu để giải quyết vấn đề có thể được sử dụng trong nhiều tình huống khác nhau. 

⚠️ Chú ý
-----------------
- Design pattern không phải là giải pháp cho tất cả những vấn đề của bạn.
- Đừng cố thay đổi chúng; những thứ tồi tệ có thể xảy ra nếu bạn làm điều đó. 
- Hãy nhớ rằng design patterns là những giải pháp  **cho** những vấn đê, không phải là những giải pháp **tìm ra** những vấn ; vì vậy đừng quá suy nghĩ.
- Nếu được sử dụng đúng chỗ đúng cách, nó có thể là cứu tinh; hoặc ngược lại code của bạn sễ trở thành một mớ hỗn độn.

> Cũng chú ý rằng  code mẫu dưới đây sử dụng PHP-7, tuy nhiêu điều này sẽ không cản chở bạn bởi vì các khái niệm cũng tương tự nhau.

Các mẫu Design Patterns
-----------------

* [Creational](#creational-design-patterns)
* [Structural](#structural-design-patterns)
* [Behavioral](#behavioral-design-patterns)

Creational Design Patterns
==========================

Nói một cách đơn 
> Creational patterns là tập trung hướng tới cách khởi tạo một đối tượng hoặc một nhóm đối tượng liên quan 

Wikipedia nói
> Trong sản xuất phần mềm, creational design patterns là các mẫu thiết kế nhằm đáp ứng các cơ chế tạo đối tượng, cố gắng tạo các đôi tượng để phù hợp với mỗi tình huống. Hình thức tạo đối tượng cơ bản có thể dẫn đến các vấn đề về thiết kế hoặc gia tăng độ phức tạp đối với thiết kế. Creational design patterns giải quyết vấn đề này bằng cách kiểm soát việc tạo ra đối tượng này.

 * [Simple Factory](#-simple-factory)
 * [Factory Method](#-factory-method)
 * [Abstract Factory](#-abstract-factory)
 * [Builder](#-builder)
 * [Prototype](#-prototype)
 * [Singleton](#-singleton)

🏠 Simple Factory
--------------
Ví dụ thực tế
> Xét, Bạn đang xây dựng một ngôi nhà và bạn cần cửa. Bạn có thể mặc bộ đồ thợ mộc của bạn, mang một ít gỗ, keo dán, đinh và tất cả các công cụ cần thiết để làm một cái cửa và bắt đầu làm nó trong ngôi nhà của bạn hoặc đơn giản bạn chỉ cần gọi tới xưởng sản xuất và lấy được cái cửa đã được làm sẵn cho bạn để bạn không phải tìm hiểu bất cứ điều gì về việc làm cửa hay đối phó với mớ hỗn độn từ việc là cái cửa đó.

Nói một cách đơn giản
> Simple factory đơn giản là tao một phần tử cho client mà không thể hiện bất kì logic về khởi tạo nào cho client

Wikipedia nói
> Trong lập trình hướng đối tượng (OOP), Một factory là một đối tượng để tạo các đối tượng khác  – Một factory đúng là một hàm hoặc một một phương thức trả về các đối tượng của một nguyên mẫu khác hoặc một class gọi từ một số các phương thức , được gọi là "new".

**Ví dụ**

Trước hết chúng ta có một interface Door và được implement
```php
interface Door
{
    public function getWidth(): float;
    public function getHeight(): float;
}

class WoodenDoor implements Door
{
    protected $width;
    protected $height;

    public function __construct(float $width, float $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function getHeight(): float
    {
        return $this->height;
    }
}
```
Tiếp đó chúng ta có door factory tao ra door và trả về chúng
```php
class DoorFactory
{
    public static function makeDoor($width, $height): Door
    {
        return new WoodenDoor($width, $height);
    }
}
```
Và sau đó có thể sử dụng như sau
```php
// Make me a door of 100x200
$door = DoorFactory::makeDoor(100, 200);

echo 'Width: ' . $door->getWidth();
echo 'Height: ' . $door->getHeight();

// Make me a door of 50x100
$door2 = DoorFactory::makeDoor(50, 100);
```

**Khi nào sử dụng**

Khi tạo một đối tượng không phải là một nhiêm vụ và liên quan tới một số logic, hãy ghi nhớ việc đặt nó vào trong một factory chuyên dụng thay vì lặp lại đoạn code tương tự ở mọi nơi.

🏭 Factory Method
--------------

Ví dụ thực tế
>Xét trường hợp của một người quản lý tuyển dụng. Một người không thể nào phỏng vấn từng vị trí. Dựa trên việc tuyển nhân viên, cô ấy phải quyết định và ủy nhiệm các bước phỏng vấn cho những người khác nhau

Nói một cách đơn giản
> Nó cung cấp một cách ủy quyền khởi tạo logic cho các lớp con.

Wikipedia nói
> Trong lập trinh dựa trên lớp, mẫu factory method  là một mẫu creational sử dụng các factory method để xử lý vấn đề tạo đối tượng mà không phải chỉ định lớp chính xác của đối tượng sẽ được tạo. Điều này được thức hiện bằng cách tạo ra các đôi tượng nhờ gọi tới một factory method — hoặc chỉ định một interface và  implement các lớp con, hoặc implemented trên một lớp cơ sở và tùy ý overrid bởi các lớp dẫn xuất — thay vì gọi tới một constructor.

 **Ví dụ**

Lấy ví dụ quản lý tuyển dụng của chúng tôi ở trên. Trước hết chúng ta có một interface interviewer và được implement

```php
interface Interviewer
{
    public function askQuestions();
}

class Developer implements Interviewer
{
    public function askQuestions()
    {
        echo 'Asking about design patterns!';
    }
}

class CommunityExecutive implements Interviewer
{
    public function askQuestions()
    {
        echo 'Asking about community building';
    }
}
```

Bời giờ chúng ta tạo `HiringManager`

```php
abstract class HiringManager
{

    // Factory method
    abstract protected function makeInterviewer(): Interviewer;

    public function takeInterview()
    {
        $interviewer = $this->makeInterviewer();
        $interviewer->askQuestions();
    }
}

```
Bây giờ chúng ta có thể extend và required interviewer
```php
class DevelopmentManager extends HiringManager
{
    protected function makeInterviewer(): Interviewer
    {
        return new Developer();
    }
}

class MarketingManager extends HiringManager
{
    protected function makeInterviewer(): Interviewer
    {
        return new CommunityExecutive();
    }
}
```
Chúng ta có thể sử dụng như

```php
$devManager = new DevelopmentManager();
$devManager->takeInterview(); // Output: Asking about design patterns

$marketingManager = new MarketingManager();
$marketingManager->takeInterview(); // Output: Asking about community building.
```

**Khi nào sử dụng**

Hữu ích khi có một sử lý chung trong một lớp  lớp con cần thiết có thể thay đổi được khi chạy. Hay nói cách khác, khi client  không biết chính xác lớp con nó co thể cần.

🔨 Abstract Factory
----------------

Ví dụ thực tế
> Mở rộng ví dụ về  door từ Simple Factory. Căn cứ vào nhu cầu của bạn, bạn có thể nhận được một cửa gỗ từ một cửa hàng cửa gỗ, cửa bằng sắt từ cửa hàng cửa sắt hoặc cửa nhựa PVC từ cửa hàng tạp hóa. Thêm vào đó bạn có thể cần một người thợ với các khĩ thuật khác nhau cho từng loại cửa, ví dụ thợ mộc cho cửa gỗ thợ hàn cho cửa sắt v.v... Như bạn thấy có sự liên qua giữa các cửa cửa gỗ cần thợ mộc cửa sắt cần thợ hạn v.v...

Nói một cách đơn giản
> Nó là một factory của các factory; một nhóm các factory đơn lẻ nhưng các factory liên quan phụ thuộc với nhau mà không cần chỉ định các lớp cụ thể của chúng.

Wikipedia nói
> Mẫu abstract factory cung cấp một giải pháp để  gói gọn một nhóm các factory riêng lẻ có một chủ đề chung mà không cần chỉ định các lớp cụ thể của họ

**Ví dụ**

Dịch ví dụ ở trên. Trước hết ta cần interface `Door` và implement nó

```php
interface Door
{
    public function getDescription();
}

class WoodenDoor implements Door
{
    public function getDescription()
    {
        echo 'I am a wooden door';
    }
}

class IronDoor implements Door
{
    public function getDescription()
    {
        echo 'I am an iron door';
    }
}
```
Sau đó, chúng tôi có một số người thợ phù hợp cho từng loại cửa

```php
interface DoorFittingExpert
{
    public function getDescription();
}

class Welder implements DoorFittingExpert
{
    public function getDescription()
    {
        echo 'I can only fit iron doors';
    }
}

class Carpenter implements DoorFittingExpert
{
    public function getDescription()
    {
        echo 'I can only fit wooden doors';
    }
}
```

Bây giờ chúng ta có abstract factory cho phép chúng ta liên kết các đối tượng có liên quan tức là  nhà máy sản xuất cửa gỗ sẽ tạo ra cánh cửa gỗ và chuyên gia lắp cửa gỗ, và nhà máy sản xuất cửa sắt sẽ tạo ra cánh cửa sắt và chuyên gia lắp cửa sắt
```php
interface DoorFactory
{
    public function makeDoor(): Door;
    public function makeFittingExpert(): DoorFittingExpert;
}

// Wooden factory to return carpenter and wooden door
class WoodenDoorFactory implements DoorFactory
{
    public function makeDoor(): Door
    {
        return new WoodenDoor();
    }

    public function makeFittingExpert(): DoorFittingExpert
    {
        return new Carpenter();
    }
}

// Iron door factory to get iron door and the relevant fitting expert
class IronDoorFactory implements DoorFactory
{
    public function makeDoor(): Door
    {
        return new IronDoor();
    }

    public function makeFittingExpert(): DoorFittingExpert
    {
        return new Welder();
    }
}
```
Và bạn có thể sử dụng như
```php
$woodenFactory = new WoodenDoorFactory();

$door = $woodenFactory->makeDoor();
$expert = $woodenFactory->makeFittingExpert();

$door->getDescription();  // Output: I am a wooden door
$expert->getDescription(); // Output: I can only fit wooden doors

// Same for Iron Factory
$ironFactory = new IronDoorFactory();

$door = $ironFactory->makeDoor();
$expert = $ironFactory->makeFittingExpert();

$door->getDescription();  // Output: I am an iron door
$expert->getDescription(); // Output: I can only fit iron doors
```

Như bạn có thể thấy nhà máy cửa gỗ nhóm `carpenter` và `wooden door` cũng như vậy nhà máy cửa sắt nhóm `iron door`  `welder`. Và do đó nó đã giúp chúng tôi đảm bảo rằng đối với mỗi cánh cửa được tạo ra, chúng tôi không nhận được một chuyên gia phù hợp sai.

**Khi nào sử dụng**

Khi có sự phụ thuộc tương quan giữa các logic phức tạp có liên   liên quan

👷 Builder
--------------------------------------------
Ví dụ thực tế
> Hãy tưởng tượng là bạn đang ở Hardee's và bạn đặt một đơn hàng , hãy nói "Big hardee" và họ đưa cho bạn mà không có bất kì câu hỏi nào; đây là một ví dụ về simple factory. Nhưng đâu là những trường hợp khi logic khởi tạo liên quan tới nhiều bước. Ví dụ như bạn muốn tùy chỉnh đơn Subway, bạn có nhiều lựa chọn trong việc chiếc burger của bạn được làm như nào ví dụ như bạn đang muốn bánh mì gì? loại sốt mà bạn muốn?... Trong những trường hợp như vậy, builder pattern được sử dụng như một giải pháp.

Nói một cách đơn giản
> Cho phép bạn bạn tạo các object có đặc điểm khác nhau trong khi tránh bị ảnh hưởng việc khởi tạo. Nó hữu dụng khi có thể tạo nhiều tùy chọn cho một object. Hoặc khi có quá nhiều bước trong việc tạo ra một object.

Wikipedia nói
> builder pattern là một phần mền design pattern tạo ra các đối tượng với ý định tìm kiếm giải pháp chống lại việc khởi tạo.

Nói xa thêm chút về mô hình chống constructor. Tại một thời điểm khác, chúng tôi đã thấy một constructor như dưới đây:

```php
public function __construct($size, $cheese = true, $pepperoni = true, $tomato = false, $lettuce = true)
{
}
```

Như bạn thấy, số lượng tham số của hàm khởi tạo có thể nhanh chóng làm bạn mất kiểm soát và nó dần trở nên rất khó hiểu về sự sắp xếp các tham số. Thêm nữa là danh sách những tham số có thể tiếp tục phát triển nếu bạn muốn thêm nhiều option trong tương lai. Điều này được gọi là mô hình chống constructor.

**Ví dụ**

Cách thay thế hợp lý là sử dụng builder pattern. Trước chúng ta có buger cái chúng ta muốn làm.

```php
class Burger
{
    protected $size;

    protected $cheese = false;
    protected $pepperoni = false;
    protected $lettuce = false;
    protected $tomato = false;

    public function __construct(BurgerBuilder $builder)
    {
        $this->size = $builder->size;
        $this->cheese = $builder->cheese;
        $this->pepperoni = $builder->pepperoni;
        $this->lettuce = $builder->lettuce;
        $this->tomato = $builder->tomato;
    }
}
```

Và chúng ta có một builder

```php
class BurgerBuilder
{
    public $size;

    public $cheese = false;
    public $pepperoni = false;
    public $lettuce = false;
    public $tomato = false;

    public function __construct(int $size)
    {
        $this->size = $size;
    }

    public function addPepperoni()
    {
        $this->pepperoni = true;
        return $this;
    }

    public function addLettuce()
    {
        $this->lettuce = true;
        return $this;
    }

    public function addCheese()
    {
        $this->cheese = true;
        return $this;
    }

    public function addTomato()
    {
        $this->tomato = true;
        return $this;
    }

    public function build(): Burger
    {
        return new Burger($this);
    }
}
```
Và sau đó có thể sử dụng như sau:

```php
$burger = (new BurgerBuilder(14))
                    ->addPepperoni()
                    ->addLettuce()
                    ->addTomato()
                    ->build();
```

**Khi nào sử dụng**

Khi có thể có một số đặc điểm của object và tránh việc chống lại khởi tạo. Sự khác biệt chính của factory pattern là đây; factory pattern được sử dụng khi việc khởi tạo chỉ có một bước trong tiến trình trong khi builder pattern được sử dụng khi có nhiều bước trong quá trình.

🐑 Prototype
------------
Ví dụ thực tế
> Bạn có nhớ dolly? Con cừu mà được nhân bản! Cho phép không nói chi tiết nhưng điểm mấu chốt ở đây là nhân bản.

Nói một cách đơn giản
> Việc tạo object dựa trên một object đã tồn tại thông qua việc nhân bản.


Wikipedia nói
> Prototype pattern là một creational design pattern trong phát triển phần mềm. Nó được sử dụng khi kiểu của object cần tạo được định nghĩa bởi một phần tử nguyên mẫu, giống như việc nhân bản nó để tạo ra một object mới.

Nói ngắn gọn, nó cho phép bạn tạo một bản sao chpes một object đã tồn tại và sửa đổi nó theo nhu cầu của bạn thay vì trải qua các sự cố khi tạo một object từ đầu và thiết lập lại nó.

**Ví dụ**

Trong PHP, nó khá dễ dàng để sử dụng `clone`

```php
class Sheep
{
    protected $name;
    protected $category;

    public function __construct(string $name, string $category = 'Mountain Sheep')
    {
        $this->name = $name;
        $this->category = $category;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setCategory(string $category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }
}
```
Sau đó nó có thể clone như dưới đây
```php
$original = new Sheep('Jolly');
echo $original->getName(); // Jolly
echo $original->getCategory(); // Mountain Sheep

// Clone and modify what is required
$cloned = clone $original;
$cloned->setName('Dolly');
echo $cloned->getName(); // Dolly
echo $cloned->getCategory(); // Mountain sheep
```

Bạn cũng có thể sử dụng  magic method `__clone` để sửa đổi các hành vi khi nhân bản.

**Khi nào sử dụng**

Khi một object được yêu cầu phải tương tự như object hiện có hoặc khi việc khởi tạo mất nhiều công hơn việc nhân bản.

💍 Singleton
------------
Ví dụ thực tế
> Cùng một lúc chỉ có thể có một tổng thống đối với mỗi quốc gia. Cùng một tổng thống phải đưa ra được hành động bất cứ khi nào nhiệm vụ gọi. Tổng thống ở đây là một singleton.

Nói đơn giản
> Đảm bảo là chỉ có một đối tượng duy nhất của mỗi class được tạo ra.

Wikipedia nói
> Trong sản xuất phần mền, singleton pattern là một phần mền design pattern hạn chế sự khởi tạo của một lớp đối với một đối tượng.Điều này rất hữu ích khi cần một đối tượng chính xác để điều phối các hành động trên toàn hệ thống.

Singleton pattern thực sự được coi là một mô hình chống và lạm dụng nó nên tránh. Nó không nhất thiết là xấu và có thể có một số trường hợp sử dụng hợp lệ nhưng nên được sử dụng thận trọng vì nó giới thiệu một trạng thái toàn cầu trong ứng dụng của bạn và thay đổi nó ở một nơi có thể ảnh hưởng đến các khu vực khác và nó có thể trở nên khá khó khăn để gỡ lỗi. Điều tệ hại khác về họ là nó làm cho mã của bạn được kết hợp chặt chẽ cộng với chế nhạo singleton có thể khó khăn.

**Ví dụ**

Tạo một singleton, làm một  constructor private,  vô hiệu hóa nhân bản, vô hiệu hóa phần mở rộng và tạo một biến tĩnh để chứa phần tử đó
```php
final class President
{
    private static $instance;

    private function __construct()
    {
        // Hide the constructor
    }

    public static function getInstance(): President
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __clone()
    {
        // Disable cloning
    }

    private function __wakeup()
    {
        // Disable unserialize
    }
}
```
Sau đó để sử dụng
```php
$president1 = President::getInstance();
$president2 = President::getInstance();

var_dump($president1 === $president2); // true
```

Structural Design Patterns
==========================
Nói đơn giản
> Structural patterns chủ yếu liên quan đến thành phần của đối tượng hay nói cách khác là cách các thực thể sử dụng lẫn nhau. Hoặc một lời giải thích khác là, chúng giúp trả lời "Làm thế nào để xây dựng một thành phần của phần mềm ?"

Wikipedia nói
> Trong sản xuất phần mền, Structural patterns là các mẫu thiết kế làm thiết kết dễ dàng hơn bằng cách xác định một cách đơn giản để nhận ra mối quan hệ giữa các thực thể.
 * [Adapter](#-adapter)
 * [Bridge](#-bridge)
 * [Composite](#-composite)
 * [Decorator](#-decorator)
 * [Facade](#-facade)
 * [Flyweight](#-flyweight)
 * [Proxy](#-proxy)

🔌 Adapter
-------
Ví dụ thực tế
> Hãy giả sử rằng bạn có một số hình ảnh trong thẻ nhớ của bạn và bạn cần phải chuyển chúng vào máy tính của bạn. Để chuyển chúng, bạn cần một bộ chuyển đổi tương thích với cổng máy tính của bạn để bạn có thể gắn thẻ nhớ vào máy tính. Trong trường hợp này đầu đọc thẻ là một bộ chuyển đổi.

> Một ví dụ khác là bộ chuyển đổi nguồn nổi tiếng, một cái phích cắm 3 chân không thể cắm vào ổ 2 chân, nó cần sử dụng một bộ chuyển đổi nguồn mà làm cho nó tương thích với loại 2 chân. 

> Một ví dụ khác sẽ là một dịch giả dịch các từ được nói bởi một người khác.

Nói đơn giản
> Adapter pattern cho phép bạn bao lại một đối tượng không tương thích khác trong một bộ chuyển đổi để làm cho nó tương thích với một class khác.

Wikipedia nói
> Trong sản xuất phần mền, adapter pattern là một software design pattern mà cho phép interface của một class đã tồn tại được sử dụng như một interface khác. Nó thường được sử dụng để làm cho các class đã tồn tại làm việc với các class khác mà không phải chỉ sửa code của chúng.

**Ví dụ**

Xem xét một game nơi có một hunter và anh ta săn lion.

Đầu tiên chúng ta có interface `Lion` mà tất cả sư tử đều implement

```php
interface Lion
{
    public function roar();
}

class AfricanLion implements Lion
{
    public function roar()
    {
    }
}

class AsianLion implements Lion
{
    public function roar()
    {
    }
}
```
Và thợ săn mong muốn bất kì implement của `Lion` interface để săn.
```php
class Hunter
{
    public function hunt(Lion $lion)
    {
        $lion->roar();
    }
}
```

Bây giờ chúng ta sử dụng thêm một `WildDog` trong chò chơi của chúng ta để thợ săn có thể đi săn. Nhưng chúng ta không thể trực tiếp làm vậy bởi chó có một interface khác. Để làm cho nó tương thích với interface của thợ săn, chúng ta sẽ tạo một adapter tương thích.

```php
// This needs to be added to the game
class WildDog
{
    public function bark()
    {
    }
}

// Adapter around wild dog to make it compatible with our game
class WildDogAdapter implements Lion
{
    protected $dog;

    public function __construct(WildDog $dog)
    {
        $this->dog = $dog;
    }

    public function roar()
    {
        $this->dog->bark();
    }
}
```
Và bây giờ `WildDog` có thể được sử dụng trong game của chúng ta bằng cách sử dụng `WildDogAdapter`.

```php
$wildDog = new WildDog();
$wildDogAdapter = new WildDogAdapter($wildDog);

$hunter = new Hunter();
$hunter->hunt($wildDogAdapter);
```

🚡 Bridge
------
Ví dụ thực tế
> Xem xét bạn có một website với các trang khác nhau và bạn muốn cho phép người dùng thay đổi theme. Bạn sẽ làm cái gì ? Tạo nhiều bản copy cho mỗi trang cho mỗi theme hoặc bạn sẽ tạo riêng và tải chúng dựa trên sở thích của người dùng ? Bridge pattern cho phép bạn làm điều thứ 2.

![With and without the bridge pattern](https://cloud.githubusercontent.com/assets/11269635/23065293/33b7aea0-f515-11e6-983f-98823c9845ee.png)

Nói đơn giản
> Bridge pattern  ưu tiên composition hơn inheritance. Chi tiết triển khai được đẩy từ một hệ thống phân cấp đến một đối tượng khác với một hệ thống phân cấp riêng biệt.

Wikipedia nói
> The bridge pattern là một design pattern sử dụng trong kỹ thuật phần mềm có nghĩa là "tách rời một sự trừu tượng khỏi việc thực hiện nó để hai phần có thể thay đổi một cách độc lập".

**Ví dụ**

Đang dịch ví dụ WebPage ở trên. Ở đây chúng ta có hệ thống phân cấp `WebPage`

```php
interface WebPage
{
    public function __construct(Theme $theme);
    public function getContent();
}

class About implements WebPage
{
    protected $theme;

    public function __construct(Theme $theme)
    {
        $this->theme = $theme;
    }

    public function getContent()
    {
        return "About page in " . $this->theme->getColor();
    }
}

class Careers implements WebPage
{
    protected $theme;

    public function __construct(Theme $theme)
    {
        $this->theme = $theme;
    }

    public function getContent()
    {
        return "Careers page in " . $this->theme->getColor();
    }
}
```
Và hệ thống phân cấp theme riêng rẽ
```php

interface Theme
{
    public function getColor();
}

class DarkTheme implements Theme
{
    public function getColor()
    {
        return 'Dark Black';
    }
}
class LightTheme implements Theme
{
    public function getColor()
    {
        return 'Off white';
    }
}
class AquaTheme implements Theme
{
    public function getColor()
    {
        return 'Light blue';
    }
}
```
Và cả 2 hệ thống phân cấp
```php
$darkTheme = new DarkTheme();

$about = new About($darkTheme);
$careers = new Careers($darkTheme);

echo $about->getContent(); // "About page in Dark Black";
echo $careers->getContent(); // "Careers page in Dark Black";
```

🌿 Composite
-----------------

Ví dụ thực tế
> Mọi tổ chức đều bao gồm các nhân viên. Mỗi nhân viên có cùng tính năng như có một mức lương, có một số trách nhiệm, có thể hoặc không thể báo cáo cho ai đó, có thể hoặc có thể không có một số cấp dưới, v.v.

Nói đơn giản
> Composite pattern cho phép client xử lý các đối tượng riêng lẻ theo cách thống nhấ

Wikipedia nói
> Trong sản xuất phần mền, composite pattern là một mẫu thiết kế phân vùng. Nó mô tả rằng một nhóm các đối tượng được xử lý giống như một phần tử đơn lẻ của một đối tượng. Mục đích của một composite là để "soạn" các đối tượng vào cấu trúc cây để đại diện cho toàn bộ hệ thống phân cấp. Việc triển khai composite pattern cho phép  các client xử lý các đối tượng và bố cục riêng lẻ một cách thống nhất.

**Ví dụ**

Lấy ví dụ nhân viên của chúng ta ở trên. Ở đây chúng ta có các loại nhân viên khác nhau

```php
interface Employee
{
    public function __construct(string $name, float $salary);
    public function getName(): string;
    public function setSalary(float $salary);
    public function getSalary(): float;
    public function getRoles(): array;
}

class Developer implements Employee
{
    protected $salary;
    protected $name;
    protected $roles;
    
    public function __construct(string $name, float $salary)
    {
        $this->name = $name;
        $this->salary = $salary;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setSalary(float $salary)
    {
        $this->salary = $salary;
    }

    public function getSalary(): float
    {
        return $this->salary;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }
}

class Designer implements Employee
{
    protected $salary;
    protected $name;
    protected $roles;

    public function __construct(string $name, float $salary)
    {
        $this->name = $name;
        $this->salary = $salary;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setSalary(float $salary)
    {
        $this->salary = $salary;
    }

    public function getSalary(): float
    {
        return $this->salary;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }
}
```

Sau đó, chúng ta có một tổ chức bao gồm nhiều loại nhân viên khác nhau

```php
class Organization
{
    protected $employees;

    public function addEmployee(Employee $employee)
    {
        $this->employees[] = $employee;
    }

    public function getNetSalaries(): float
    {
        $netSalary = 0;

        foreach ($this->employees as $employee) {
            $netSalary += $employee->getSalary();
        }

        return $netSalary;
    }
}
```

Và sau đó nó có thể được sử dụng như sau

```php
// Prepare the employees
$john = new Developer('John Doe', 12000);
$jane = new Designer('Jane Doe', 15000);

// Add them to organization
$organization = new Organization();
$organization->addEmployee($john);
$organization->addEmployee($jane);

echo "Net salaries: " . $organization->getNetSalaries(); // Net Salaries: 27000
```

☕ Decorator
-------------

Ví dụ thực tế

>  Hãy tưởng tượng bạn chạy một cửa hàng dịch vụ xe hơi cung cấp nhiều dịch vụ. Bây giờ làm thế nào bạn tính toán hóa đơn ? Bạn chọn một dịch vụ và tự động tiếp tục bổ sung giá cho các dịch vụ được cung cấp cho đến khi bạn nhận được chi phí cuối cùng. Ở đây mỗi loại dịch vụ là một decorator.


Nói đơn giản
> Decorator pattern cho phép bạn tự động thay đổi hành vi của một đối tượng trong thời gian chạy bằng cách gói chúng trong một đối tượng của một decorator class.

Wikipedia nói
>  Trong lập trình hướng đối tượng, decorator pattern là một design pattern mà cho phép  hành vi được thêm vào một đối tượng riêng lẻ, tĩnh hoặc động, mà không ảnh hưởng đến hành vi của các đối tượng khác từ cùng một class. Decorator pattern thường hữu ích cho the Single Responsibility Principle, vì nó cho phép chức năng được phân chia giữa các lớp với các lĩnh vực quan tâm duy nhất.


**Ví dụ**

Lấy cafe cho ví dụ. Đầu tiên chúng ta có một coffe đơn giản thực hiện implements với coffee interface


```php
interface Coffee
{
    public function getCost();
    public function getDescription();
}

class SimpleCoffee implements Coffee
{
    public function getCost()
    {
        return 10;
    }

    public function getDescription()
    {
        return 'Simple coffee';
    }
}
```
Chúng ta muốn mở rộng code cho phép các tuỳ chọn được sử đổi nếu có yêu cầu. Hãy làm một vài add-ons (decorators)
```php
class MilkCoffee implements Coffee
{
    protected $coffee;

    public function __construct(Coffee $coffee)
    {
        $this->coffee = $coffee;
    }

    public function getCost()
    {
        return $this->coffee->getCost() + 2;
    }

    public function getDescription()
    {
        return $this->coffee->getDescription() . ', milk';
    }
}

class WhipCoffee implements Coffee
{
    protected $coffee;

    public function __construct(Coffee $coffee)
    {
        $this->coffee = $coffee;
    }

    public function getCost()
    {
        return $this->coffee->getCost() + 5;
    }

    public function getDescription()
    {
        return $this->coffee->getDescription() . ', whip';
    }
}

class VanillaCoffee implements Coffee
{
    protected $coffee;

    public function __construct(Coffee $coffee)
    {
        $this->coffee = $coffee;
    }

    public function getCost()
    {
        return $this->coffee->getCost() + 3;
    }

    public function getDescription()
    {
        return $this->coffee->getDescription() . ', vanilla';
    }
}
```

Bây giờ hãy tạo một coffee

```php
$someCoffee = new SimpleCoffee();
echo $someCoffee->getCost(); // 10
echo $someCoffee->getDescription(); // Simple Coffee

$someCoffee = new MilkCoffee($someCoffee);
echo $someCoffee->getCost(); // 12
echo $someCoffee->getDescription(); // Simple Coffee, milk

$someCoffee = new WhipCoffee($someCoffee);
echo $someCoffee->getCost(); // 17
echo $someCoffee->getDescription(); // Simple Coffee, milk, whip

$someCoffee = new VanillaCoffee($someCoffee);
echo $someCoffee->getCost(); // 20
echo $someCoffee->getDescription(); // Simple Coffee, milk, whip, vanilla
```

📦 Facade
----------------

Ví dụ thực tế
> Làm thế nào bạn mở được máy tính ? Bạn nói "Nhấn nút nguồn" Đó là điều bạn tin bởi vì bạn đang sử dụng một interface đơn giản mà máy tính cung cấp ở bên ngoài, bên trong nó phải làm rất nhiều thứ để làm cho nó xảy ra. Interface đơn giản này với hệ thống con phức tạp là một facade.

Nói đơn giản
> Facade pattern cung cấp một giao diện đơn giản cho một hệ thống con phức tạp.

Wikipedia nói
> Một facade là một đối tượng cung cấp một giao diện đơn giản cho một phần lớn hơn của code, giống như class của thư viện.

**Ví dụ**

Lấy ví dụ máy tính của chúng tôi từ trên. Ở đây chúng ta có class Computer

```php
class Computer
{
    public function getElectricShock()
    {
        echo "Ouch!";
    }

    public function makeSound()
    {
        echo "Beep beep!";
    }

    public function showLoadingScreen()
    {
        echo "Loading..";
    }

    public function bam()
    {
        echo "Ready to be used!";
    }

    public function closeEverything()
    {
        echo "Bup bup bup buzzzz!";
    }

    public function sooth()
    {
        echo "Zzzzz";
    }

    public function pullCurrent()
    {
        echo "Haaah!";
    }
}
```
Ở đây chúng ta có facade
```php
class ComputerFacade
{
    protected $computer;

    public function __construct(Computer $computer)
    {
        $this->computer = $computer;
    }

    public function turnOn()
    {
        $this->computer->getElectricShock();
        $this->computer->makeSound();
        $this->computer->showLoadingScreen();
        $this->computer->bam();
    }

    public function turnOff()
    {
        $this->computer->closeEverything();
        $this->computer->pullCurrent();
        $this->computer->sooth();
    }
}
```
Bây giờ sử dụng facade
```php
$computer = new ComputerFacade(new Computer());
$computer->turnOn(); // Ouch! Beep beep! Loading.. Ready to be used!
$computer->turnOff(); // Bup bup buzzz! Haah! Zzzzz
```

🍃 Flyweight
---------

Ví dụ thực tế
> Bạn đã từng uống trà tươi từ một số gian hàng chưa ? Họ thường làm nhiều hơn một cốc mà bạn yêu cầu và lưu phần còn lại cho bất kỳ khách hàng nào khác để tiết kiệm tài nguyên ví dụ gas. Flyweight pattern là tất cả về điều đó tức là chia sẻ.

Nói đơn giản
>  Nó được sử dụng để giảm thiểu mức sử dụng bộ nhớ hoặc chi phí tính toán bằng cách chia sẻ càng nhiều càng tốt với các đối tượng tương tự.
  
Wikipedia nói
  > Trong lập trình máy tính, flyweight là một software design pattern. Một flyweight là một đối tượng giảm thiểu việc sử dụng bộ nhớ bằng cách chia sẻ càng nhiều dữ liệu càng tốt với các đối tượng tương tự khác, nó là một cách để sử dụng các đối tượng với số lượng lớn khi một biểu diễn lặp lại đơn giản sẽ sử dụng một lượng bộ nhớ không thể chấp nhận được.

**Ví dụ**

Dịch ví dụ về trà của chúng ta ở trên. Đầu tiên chúng ta có các loại trà và người pha trà

```php
// Anything that will be cached is flyweight.
// Types of tea here will be flyweights.
class KarakTea
{
}

// Acts as a factory and saves the tea
class TeaMaker
{
    protected $availableTea = [];

    public function make($preference)
    {
        if (empty($this->availableTea[$preference])) {
            $this->availableTea[$preference] = new KarakTea();
        }

        return $this->availableTea[$preference];
    }
}
```

Sau đó chúng ta có `TeaShop` nhận đơn đặt hàng và phục vụ

```php
class TeaShop
{
    protected $orders;
    protected $teaMaker;

    public function __construct(TeaMaker $teaMaker)
    {
        $this->teaMaker = $teaMaker;
    }

    public function takeOrder(string $teaType, int $table)
    {
        $this->orders[$table] = $this->teaMaker->make($teaType);
    }

    public function serve()
    {
        foreach ($this->orders as $table => $tea) {
            echo "Serving tea to table# " . $table;
        }
    }
}
```
Và nó có thể được sử dụng như dưới đây

```php
$teaMaker = new TeaMaker();
$shop = new TeaShop($teaMaker);

$shop->takeOrder('less sugar', 1);
$shop->takeOrder('more milk', 2);
$shop->takeOrder('without sugar', 5);

$shop->serve();
// Serving tea to table# 1
// Serving tea to table# 2
// Serving tea to table# 5
```

🎱 Proxy
-------------------
Ví dụ thực tế
> Bạn đã bao giờ sử dụng một thẻ truy cập để đi qua một cánh cửa? Có nhiều tùy chọn để mở cánh cửa đó ví dụ nó có thể được mở bằng cách sử dụng thẻ truy cập hoặc bằng cách nhấn một nút để vượt qua bảo mật. Chức năng chính của cửa là để mở nhưng có một proxy được thêm vào đầu nó để thêm một số chức năng. Hãy để tôi giải thích rõ hơn bằng cách sử dụng ví dụ code bên dưới.

Nói đơn giản
> Sử dụng proxy pattern, một class đại diện cho tính năng của class khác.

Wikipedia nói
> Một proxy, ở dạng tổng quát nhất của nó, là một lớp hoạt động như một giao diện cho một cái gì đó khác. Một proxy là một một đối tượng bao bọc hoặc agent đang được client gọi để truy cập đối tượng phục vụ thực đằng sau bối cảnh. Việc sử dụng proxy chỉ đơn giản là có thể chuyển tiếp đến đối tượng thực, hoặc có thể cung cấp thêm logic.Trong chức năng bổ sung proxy có thể được cung cấp, ví dụ bộ nhớ đệm khi các hoạt động trên đối tượng thực là tài nguyên sâu, hoặc kiểm tra điều kiện tiên quyết trước khi hoạt động trên đối tượng thực được gọi.

**Ví dụ**

Lấy ví dụ cửa an ninh của chúng tôi từ trên. Đầu tiên chúng ta có door interface và một implement của door

```php
interface Door
{
    public function open();
    public function close();
}

class LabDoor implements Door
{
    public function open()
    {
        echo "Opening lab door";
    }

    public function close()
    {
        echo "Closing the lab door";
    }
}
```
Sau đó, chúng ta có một proxy để bảo đảm bất kỳ cửa nào mà chúng ta muốn
```php
class SecuredDoor
{
    protected $door;

    public function __construct(Door $door)
    {
        $this->door = $door;
    }

    public function open($password)
    {
        if ($this->authenticate($password)) {
            $this->door->open();
        } else {
            echo "Big no! It ain't possible.";
        }
    }

    public function authenticate($password)
    {
        return $password === '$ecr@t';
    }

    public function close()
    {
        $this->door->close();
    }
}
```
Và đây là cách nó có thể được sử dụng
```php
$door = new SecuredDoor(new LabDoor());
$door->open('invalid'); // Big no! It ain't possible.

$door->open('$ecr@t'); // Opening lab door
$door->close(); // Closing lab door
```
Yet another example would be some sort of data-mapper implementation. For example, I recently made an ODM (Object Data Mapper) for MongoDB using this pattern where I wrote a proxy around mongo classes while utilizing the magic method `__call()`. All the method calls were proxied to the original mongo class and result retrieved was returned as it is but in case of `find` or `findOne` data was mapped to the required class objects and the object was returned instead of `Cursor`.

Behavioral Design Patterns
==========================

In plain words
> It is concerned with assignment of responsibilities between the objects. What makes them different from structural patterns is they don't just specify the structure but also outline the patterns for message passing/communication between them. Or in other words, they assist in answering "How to run a behavior in software component?"

Wikipedia says
> In software engineering, behavioral design patterns are design patterns that identify common communication patterns between objects and realize these patterns. By doing so, these patterns increase flexibility in carrying out this communication.

* [Chain of Responsibility](#-chain-of-responsibility)
* [Command](#-command)
* [Iterator](#-iterator)
* [Mediator](#-mediator)
* [Memento](#-memento)
* [Observer](#-observer)
* [Visitor](#-visitor)
* [Strategy](#-strategy)
* [State](#-state)
* [Template Method](#-template-method)

🔗 Chain of Responsibility
-----------------------

Real world example
> For example, you have three payment methods (`A`, `B` and `C`) setup in your account; each having a different amount in it. `A` has 100 USD, `B` has 300 USD and `C` having 1000 USD and the preference for payments is chosen as `A` then `B` then `C`. You try to purchase something that is worth 210 USD. Using Chain of Responsibility, first of all account `A` will be checked if it can make the purchase, if yes purchase will be made and the chain will be broken. If not, request will move forward to account `B` checking for amount if yes chain will be broken otherwise the request will keep forwarding till it finds the suitable handler. Here `A`, `B` and `C` are links of the chain and the whole phenomenon is Chain of Responsibility.

In plain words
> It helps building a chain of objects. Request enters from one end and keeps going from object to object till it finds the suitable handler.

Wikipedia says
> In object-oriented design, the chain-of-responsibility pattern is a design pattern consisting of a source of command objects and a series of processing objects. Each processing object contains logic that defines the types of command objects that it can handle; the rest are passed to the next processing object in the chain.

**Programmatic Example**

Translating our account example above. First of all we have a base account having the logic for chaining the accounts together and some accounts

```php
abstract class Account
{
    protected $successor;
    protected $balance;

    public function setNext(Account $account)
    {
        $this->successor = $account;
    }

    public function pay(float $amountToPay)
    {
        if ($this->canPay($amountToPay)) {
            echo sprintf('Paid %s using %s' . PHP_EOL, $amountToPay, get_called_class());
        } elseif ($this->successor) {
            echo sprintf('Cannot pay using %s. Proceeding ..' . PHP_EOL, get_called_class());
            $this->successor->pay($amountToPay);
        } else {
            throw new Exception('None of the accounts have enough balance');
        }
    }

    public function canPay($amount): bool
    {
        return $this->balance >= $amount;
    }
}

class Bank extends Account
{
    protected $balance;

    public function __construct(float $balance)
    {
        $this->balance = $balance;
    }
}

class Paypal extends Account
{
    protected $balance;

    public function __construct(float $balance)
    {
        $this->balance = $balance;
    }
}

class Bitcoin extends Account
{
    protected $balance;

    public function __construct(float $balance)
    {
        $this->balance = $balance;
    }
}
```

Now let's prepare the chain using the links defined above (i.e. Bank, Paypal, Bitcoin)

```php
// Let's prepare a chain like below
//      $bank->$paypal->$bitcoin
//
// First priority bank
//      If bank can't pay then paypal
//      If paypal can't pay then bit coin

$bank = new Bank(100);          // Bank with balance 100
$paypal = new Paypal(200);      // Paypal with balance 200
$bitcoin = new Bitcoin(300);    // Bitcoin with balance 300

$bank->setNext($paypal);
$paypal->setNext($bitcoin);

// Let's try to pay using the first priority i.e. bank
$bank->pay(259);

// Output will be
// ==============
// Cannot pay using bank. Proceeding ..
// Cannot pay using paypal. Proceeding ..:
// Paid 259 using Bitcoin!
```

👮 Command
-------

Real world example
> A generic example would be you ordering food at a restaurant. You (i.e. `Client`) ask the waiter (i.e. `Invoker`) to bring some food (i.e. `Command`) and waiter simply forwards the request to Chef (i.e. `Receiver`) who has the knowledge of what and how to cook.
> Another example would be you (i.e. `Client`) switching on (i.e. `Command`) the television (i.e. `Receiver`) using a remote control (`Invoker`).

In plain words
> Allows you to encapsulate actions in objects. The key idea behind this pattern is to provide the means to decouple client from receiver.

Wikipedia says
> In object-oriented programming, the command pattern is a behavioral design pattern in which an object is used to encapsulate all information needed to perform an action or trigger an event at a later time. This information includes the method name, the object that owns the method and values for the method parameters.

**Programmatic Example**

First of all we have the receiver that has the implementation of every action that could be performed
```php
// Receiver
class Bulb
{
    public function turnOn()
    {
        echo "Bulb has been lit";
    }

    public function turnOff()
    {
        echo "Darkness!";
    }
}
```
then we have an interface that each of the commands are going to implement and then we have a set of commands
```php
interface Command
{
    public function execute();
    public function undo();
    public function redo();
}

// Command
class TurnOn implements Command
{
    protected $bulb;

    public function __construct(Bulb $bulb)
    {
        $this->bulb = $bulb;
    }

    public function execute()
    {
        $this->bulb->turnOn();
    }

    public function undo()
    {
        $this->bulb->turnOff();
    }

    public function redo()
    {
        $this->execute();
    }
}

class TurnOff implements Command
{
    protected $bulb;

    public function __construct(Bulb $bulb)
    {
        $this->bulb = $bulb;
    }

    public function execute()
    {
        $this->bulb->turnOff();
    }

    public function undo()
    {
        $this->bulb->turnOn();
    }

    public function redo()
    {
        $this->execute();
    }
}
```
Then we have an `Invoker` with whom the client will interact to process any commands
```php
// Invoker
class RemoteControl
{
    public function submit(Command $command)
    {
        $command->execute();
    }
}
```
Finally let's see how we can use it in our client
```php
$bulb = new Bulb();

$turnOn = new TurnOn($bulb);
$turnOff = new TurnOff($bulb);

$remote = new RemoteControl();
$remote->submit($turnOn); // Bulb has been lit!
$remote->submit($turnOff); // Darkness!
```

Command pattern can also be used to implement a transaction based system. Where you keep maintaining the history of commands as soon as you execute them. If the final command is successfully executed, all good otherwise just iterate through the history and keep executing the `undo` on all the executed commands.

➿ Iterator
--------

Real world example
> An old radio set will be a good example of iterator, where user could start at some channel and then use next or previous buttons to go through the respective channels. Or take an example of MP3 player or a TV set where you could press the next and previous buttons to go through the consecutive channels or in other words they all provide an interface to iterate through the respective channels, songs or radio stations.  

In plain words
> It presents a way to access the elements of an object without exposing the underlying presentation.

Wikipedia says
> In object-oriented programming, the iterator pattern is a design pattern in which an iterator is used to traverse a container and access the container's elements. The iterator pattern decouples algorithms from containers; in some cases, algorithms are necessarily container-specific and thus cannot be decoupled.

**Programmatic example**

In PHP it is quite easy to implement using SPL (Standard PHP Library). Translating our radio stations example from above. First of all we have `RadioStation`

```php
class RadioStation
{
    protected $frequency;

    public function __construct(float $frequency)
    {
        $this->frequency = $frequency;
    }

    public function getFrequency(): float
    {
        return $this->frequency;
    }
}
```
Then we have our iterator

```php
use Countable;
use Iterator;

class StationList implements Countable, Iterator
{
    /** @var RadioStation[] $stations */
    protected $stations = [];

    /** @var int $counter */
    protected $counter;

    public function addStation(RadioStation $station)
    {
        $this->stations[] = $station;
    }

    public function removeStation(RadioStation $toRemove)
    {
        $toRemoveFrequency = $toRemove->getFrequency();
        $this->stations = array_filter($this->stations, function (RadioStation $station) use ($toRemoveFrequency) {
            return $station->getFrequency() !== $toRemoveFrequency;
        });
    }

    public function count(): int
    {
        return count($this->stations);
    }

    public function current(): RadioStation
    {
        return $this->stations[$this->counter];
    }

    public function key()
    {
        return $this->counter;
    }

    public function next()
    {
        $this->counter++;
    }

    public function rewind()
    {
        $this->counter = 0;
    }

    public function valid(): bool
    {
        return isset($this->stations[$this->counter]);
    }
}
```
And then it can be used as
```php
$stationList = new StationList();

$stationList->addStation(new RadioStation(89));
$stationList->addStation(new RadioStation(101));
$stationList->addStation(new RadioStation(102));
$stationList->addStation(new RadioStation(103.2));

foreach($stationList as $station) {
    echo $station->getFrequency() . PHP_EOL;
}

$stationList->removeStation(new RadioStation(89)); // Will remove station 89
```

👽 Mediator
========

Real world example
> A general example would be when you talk to someone on your mobile phone, there is a network provider sitting between you and them and your conversation goes through it instead of being directly sent. In this case network provider is mediator.

In plain words
> Mediator pattern adds a third party object (called mediator) to control the interaction between two objects (called colleagues). It helps reduce the coupling between the classes communicating with each other. Because now they don't need to have the knowledge of each other's implementation.

Wikipedia says
> In software engineering, the mediator pattern defines an object that encapsulates how a set of objects interact. This pattern is considered to be a behavioral pattern due to the way it can alter the program's running behavior.

**Programmatic Example**

Here is the simplest example of a chat room (i.e. mediator) with users (i.e. colleagues) sending messages to each other.

First of all, we have the mediator i.e. the chat room

```php
interface ChatRoomMediator 
{
    public function showMessage(User $user, string $message);
}

// Mediator
class ChatRoom implements ChatRoomMediator
{
    public function showMessage(User $user, string $message)
    {
        $time = date('M d, y H:i');
        $sender = $user->getName();

        echo $time . '[' . $sender . ']:' . $message;
    }
}
```

Then we have our users i.e. colleagues
```php
class User {
    protected $name;
    protected $chatMediator;

    public function __construct(string $name, ChatRoomMediator $chatMediator) {
        $this->name = $name;
        $this->chatMediator = $chatMediator;
    }

    public function getName() {
        return $this->name;
    }

    public function send($message) {
        $this->chatMediator->showMessage($this, $message);
    }
}
```
And the usage
```php
$mediator = new ChatRoom();

$john = new User('John Doe', $mediator);
$jane = new User('Jane Doe', $mediator);

$john->send('Hi there!');
$jane->send('Hey!');

// Output will be
// Feb 14, 10:58 [John]: Hi there!
// Feb 14, 10:58 [Jane]: Hey!
```

💾 Memento
-------
Real world example
> Take the example of calculator (i.e. originator), where whenever you perform some calculation the last calculation is saved in memory (i.e. memento) so that you can get back to it and maybe get it restored using some action buttons (i.e. caretaker).

In plain words
> Memento pattern is about capturing and storing the current state of an object in a manner that it can be restored later on in a smooth manner.

Wikipedia says
> The memento pattern is a software design pattern that provides the ability to restore an object to its previous state (undo via rollback).

Usually useful when you need to provide some sort of undo functionality.

**Programmatic Example**

Lets take an example of text editor which keeps saving the state from time to time and that you can restore if you want.

First of all we have our memento object that will be able to hold the editor state

```php
class EditorMemento
{
    protected $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }
}
```

Then we have our editor i.e. originator that is going to use memento object

```php
class Editor
{
    protected $content = '';

    public function type(string $words)
    {
        $this->content = $this->content . ' ' . $words;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function save()
    {
        return new EditorMemento($this->content);
    }

    public function restore(EditorMemento $memento)
    {
        $this->content = $memento->getContent();
    }
}
```

And then it can be used as

```php
$editor = new Editor();

// Type some stuff
$editor->type('This is the first sentence.');
$editor->type('This is second.');

// Save the state to restore to : This is the first sentence. This is second.
$saved = $editor->save();

// Type some more
$editor->type('And this is third.');

// Output: Content before Saving
echo $editor->getContent(); // This is the first sentence. This is second. And this is third.

// Restoring to last saved state
$editor->restore($saved);

$editor->getContent(); // This is the first sentence. This is second.
```

😎 Observer
--------
Real world example
> A good example would be the job seekers where they subscribe to some job posting site and they are notified whenever there is a matching job opportunity.   

In plain words
> Defines a dependency between objects so that whenever an object changes its state, all its dependents are notified.

Wikipedia says
> The observer pattern is a software design pattern in which an object, called the subject, maintains a list of its dependents, called observers, and notifies them automatically of any state changes, usually by calling one of their methods.

**Programmatic example**

Translating our example from above. First of all we have job seekers that need to be notified for a job posting
```php
class JobPost
{
    protected $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }
}

class JobSeeker implements Observer
{
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function onJobPosted(JobPost $job)
    {
        // Do something with the job posting
        echo 'Hi ' . $this->name . '! New job posted: '. $job->getTitle();
    }
}
```
Then we have our job postings to which the job seekers will subscribe
```php
class EmploymentAgency implements Observable
{
    protected $observers = [];

    protected function notify(JobPost $jobPosting)
    {
        foreach ($this->observers as $observer) {
            $observer->onJobPosted($jobPosting);
        }
    }

    public function attach(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function addJob(JobPost $jobPosting)
    {
        $this->notify($jobPosting);
    }
}
```
Then it can be used as
```php
// Create subscribers
$johnDoe = new JobSeeker('John Doe');
$janeDoe = new JobSeeker('Jane Doe');

// Create publisher and attach subscribers
$jobPostings = new EmploymentAgency();
$jobPostings->attach($johnDoe);
$jobPostings->attach($janeDoe);

// Add a new job and see if subscribers get notified
$jobPostings->addJob(new JobPost('Software Engineer'));

// Output
// Hi John Doe! New job posted: Software Engineer
// Hi Jane Doe! New job posted: Software Engineer
```

🏃 Visitor
-------
Real world example
> Consider someone visiting Dubai. They just need a way (i.e. visa) to enter Dubai. After arrival, they can come and visit any place in Dubai on their own without having to ask for permission or to do some leg work in order to visit any place here; just let them know of a place and they can visit it. Visitor pattern lets you do just that, it helps you add places to visit so that they can visit as much as they can without having to do any legwork.

In plain words
> Visitor pattern lets you add further operations to objects without having to modify them.

Wikipedia says
> In object-oriented programming and software engineering, the visitor design pattern is a way of separating an algorithm from an object structure on which it operates. A practical result of this separation is the ability to add new operations to existing object structures without modifying those structures. It is one way to follow the open/closed principle.

**Programmatic example**

Let's take an example of a zoo simulation where we have several different kinds of animals and we have to make them Sound. Let's translate this using visitor pattern

```php
// Visitee
interface Animal
{
    public function accept(AnimalOperation $operation);
}

// Visitor
interface AnimalOperation
{
    public function visitMonkey(Monkey $monkey);
    public function visitLion(Lion $lion);
    public function visitDolphin(Dolphin $dolphin);
}
```
Then we have our implementations for the animals
```php
class Monkey implements Animal
{
    public function shout()
    {
        echo 'Ooh oo aa aa!';
    }

    public function accept(AnimalOperation $operation)
    {
        $operation->visitMonkey($this);
    }
}

class Lion implements Animal
{
    public function roar()
    {
        echo 'Roaaar!';
    }

    public function accept(AnimalOperation $operation)
    {
        $operation->visitLion($this);
    }
}

class Dolphin implements Animal
{
    public function speak()
    {
        echo 'Tuut tuttu tuutt!';
    }

    public function accept(AnimalOperation $operation)
    {
        $operation->visitDolphin($this);
    }
}
```
Let's implement our visitor
```php
class Speak implements AnimalOperation
{
    public function visitMonkey(Monkey $monkey)
    {
        $monkey->shout();
    }

    public function visitLion(Lion $lion)
    {
        $lion->roar();
    }

    public function visitDolphin(Dolphin $dolphin)
    {
        $dolphin->speak();
    }
}
```

And then it can be used as
```php
$monkey = new Monkey();
$lion = new Lion();
$dolphin = new Dolphin();

$speak = new Speak();

$monkey->accept($speak);    // Ooh oo aa aa!    
$lion->accept($speak);      // Roaaar!
$dolphin->accept($speak);   // Tuut tutt tuutt!
```
We could have done this simply by having an inheritance hierarchy for the animals but then we would have to modify the animals whenever we would have to add new actions to animals. But now we will not have to change them. For example, let's say we are asked to add the jump behavior to the animals, we can simply add that by creating a new visitor i.e.

```php
class Jump implements AnimalOperation
{
    public function visitMonkey(Monkey $monkey)
    {
        echo 'Jumped 20 feet high! on to the tree!';
    }

    public function visitLion(Lion $lion)
    {
        echo 'Jumped 7 feet! Back on the ground!';
    }

    public function visitDolphin(Dolphin $dolphin)
    {
        echo 'Walked on water a little and disappeared';
    }
}
```
And for the usage
```php
$jump = new Jump();

$monkey->accept($speak);   // Ooh oo aa aa!
$monkey->accept($jump);    // Jumped 20 feet high! on to the tree!

$lion->accept($speak);     // Roaaar!
$lion->accept($jump);      // Jumped 7 feet! Back on the ground!

$dolphin->accept($speak);  // Tuut tutt tuutt!
$dolphin->accept($jump);   // Walked on water a little and disappeared
```

💡 Strategy
--------

Real world example
> Consider the example of sorting, we implemented bubble sort but the data started to grow and bubble sort started getting very slow. In order to tackle this we implemented Quick sort. But now although the quick sort algorithm was doing better for large datasets, it was very slow for smaller datasets. In order to handle this we implemented a strategy where for small datasets, bubble sort will be used and for larger, quick sort.

In plain words
> Strategy pattern allows you to switch the algorithm or strategy based upon the situation.

Wikipedia says
> In computer programming, the strategy pattern (also known as the policy pattern) is a behavioural software design pattern that enables an algorithm's behavior to be selected at runtime.

**Programmatic example**

Translating our example from above. First of all we have our strategy interface and different strategy implementations

```php
interface SortStrategy
{
    public function sort(array $dataset): array;
}

class BubbleSortStrategy implements SortStrategy
{
    public function sort(array $dataset): array
    {
        echo "Sorting using bubble sort";

        // Do sorting
        return $dataset;
    }
}

class QuickSortStrategy implements SortStrategy
{
    public function sort(array $dataset): array
    {
        echo "Sorting using quick sort";

        // Do sorting
        return $dataset;
    }
}
```

And then we have our client that is going to use any strategy
```php
class Sorter
{
    protected $sorter;

    public function __construct(SortStrategy $sorter)
    {
        $this->sorter = $sorter;
    }

    public function sort(array $dataset): array
    {
        return $this->sorter->sort($dataset);
    }
}
```
And it can be used as
```php
$dataset = [1, 5, 4, 3, 2, 8];

$sorter = new Sorter(new BubbleSortStrategy());
$sorter->sort($dataset); // Output : Sorting using bubble sort

$sorter = new Sorter(new QuickSortStrategy());
$sorter->sort($dataset); // Output : Sorting using quick sort
```

💢 State
-----
Real world example
> Imagine you are using some drawing application, you choose the paint brush to draw. Now the brush changes its behavior based on the selected color i.e. if you have chosen red color it will draw in red, if blue then it will be in blue etc.  

In plain words
> It lets you change the behavior of a class when the state changes.

Wikipedia says
> The state pattern is a behavioral software design pattern that implements a state machine in an object-oriented way. With the state pattern, a state machine is implemented by implementing each individual state as a derived class of the state pattern interface, and implementing state transitions by invoking methods defined by the pattern's superclass.
> The state pattern can be interpreted as a strategy pattern which is able to switch the current strategy through invocations of methods defined in the pattern's interface.

**Programmatic example**

Let's take an example of text editor, it lets you change the state of text that is typed i.e. if you have selected bold, it starts writing in bold, if italic then in italics etc.

First of all we have our state interface and some state implementations

```php
interface WritingState
{
    public function write(string $words);
}

class UpperCase implements WritingState
{
    public function write(string $words)
    {
        echo strtoupper($words);
    }
}

class LowerCase implements WritingState
{
    public function write(string $words)
    {
        echo strtolower($words);
    }
}

class DefaultText implements WritingState
{
    public function write(string $words)
    {
        echo $words;
    }
}
```
Then we have our editor
```php
class TextEditor
{
    protected $state;

    public function __construct(WritingState $state)
    {
        $this->state = $state;
    }

    public function setState(WritingState $state)
    {
        $this->state = $state;
    }

    public function type(string $words)
    {
        $this->state->write($words);
    }
}
```
And then it can be used as
```php
$editor = new TextEditor(new DefaultText());

$editor->type('First line');

$editor->setState(new UpperCase());

$editor->type('Second line');
$editor->type('Third line');

$editor->setState(new LowerCase());

$editor->type('Fourth line');
$editor->type('Fifth line');

// Output:
// First line
// SECOND LINE
// THIRD LINE
// fourth line
// fifth line
```

📒 Template Method
---------------

Real world example
> Suppose we are getting some house built. The steps for building might look like
> - Prepare the base of house
> - Build the walls
> - Add roof
> - Add other floors

> The order of these steps could never be changed i.e. you can't build the roof before building the walls etc but each of the steps could be modified for example walls can be made of wood or polyester or stone.

In plain words
> Template method defines the skeleton of how a certain algorithm could be performed, but defers the implementation of those steps to the children classes.

Wikipedia says
> In software engineering, the template method pattern is a behavioral design pattern that defines the program skeleton of an algorithm in an operation, deferring some steps to subclasses. It lets one redefine certain steps of an algorithm without changing the algorithm's structure.

**Programmatic Example**

Imagine we have a build tool that helps us test, lint, build, generate build reports (i.e. code coverage reports, linting report etc) and deploy our app on the test server.

First of all we have our base class that specifies the skeleton for the build algorithm
```php
abstract class Builder
{

    // Template method
    final public function build()
    {
        $this->test();
        $this->lint();
        $this->assemble();
        $this->deploy();
    }

    abstract public function test();
    abstract public function lint();
    abstract public function assemble();
    abstract public function deploy();
}
```

Then we can have our implementations

```php
class AndroidBuilder extends Builder
{
    public function test()
    {
        echo 'Running android tests';
    }

    public function lint()
    {
        echo 'Linting the android code';
    }

    public function assemble()
    {
        echo 'Assembling the android build';
    }

    public function deploy()
    {
        echo 'Deploying android build to server';
    }
}

class IosBuilder extends Builder
{
    public function test()
    {
        echo 'Running ios tests';
    }

    public function lint()
    {
        echo 'Linting the ios code';
    }

    public function assemble()
    {
        echo 'Assembling the ios build';
    }

    public function deploy()
    {
        echo 'Deploying ios build to server';
    }
}
```
And then it can be used as

```php
$androidBuilder = new AndroidBuilder();
$androidBuilder->build();

// Output:
// Running android tests
// Linting the android code
// Assembling the android build
// Deploying android build to server

$iosBuilder = new IosBuilder();
$iosBuilder->build();

// Output:
// Running ios tests
// Linting the ios code
// Assembling the ios build
// Deploying ios build to server
```

## 🚦 Wrap Up Folks

And that about wraps it up. I will continue to improve this, so you might want to watch/star this repository to revisit. Also, I have plans on writing the same about the architectural patterns, stay tuned for it.

## 👬 Contribution

- Report issues
- Open pull request with improvements
- Spread the word
- Reach out with any feedback [![Twitter URL](https://img.shields.io/twitter/url/https/twitter.com/kamranahmedse.svg?style=social&label=Follow%20%40kamranahmedse)](https://twitter.com/kamranahmedse)

## Sponsored By

- [Highig - Think and its done](http://highig.com/)

## License

[![License: CC BY 4.0](https://img.shields.io/badge/License-CC%20BY%204.0-lightgrey.svg)](https://creativecommons.org/licenses/by/4.0/)
