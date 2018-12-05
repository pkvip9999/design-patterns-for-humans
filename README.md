![Design Patterns For Humans](https://cloud.githubusercontent.com/assets/11269635/23065273/1b7e5938-f515-11e6-8dd3-d0d58de6bb9a.png)

***

<p align="center">
🎉 Ultra-simplified explanation to design patterns! 🎉
</p>
<p align="center">
Một chủ đề có thể dễ dàng làm suy nghĩ bị lung lay. Ở đây tôi cố gắng đứa nó vào tâm trí của bạn (và có thể là tôi) bằng cách giải thích chúng theo các đơn giản nhất.
</p>

***

<sub>Check out my [blog](http://kamranahmed.info) and say "hi" on [Twitter](https://twitter.com/kamranahmedse).</sub>

Giới thiệu
=================

Design patterns là các giải pháp cho các vấn đề mà lặp đi lặp lại; **hướng dẫn cách giải quyết các vấn đề nhất định**. Chúng không phải là các class, các package hoặc các thư viện mà bạn có thể đưa vào ứng dụng của bạn và chờ đợi sự kỳ diệu xảy ra. Đây là những hướng dẫn về cách giải quyết các vấn đề nhất định trong những tình huống nhất định.

> Design patterns là giải pháp cho các vấn đề định kỳ; hướng dẫn cách giải quyết các vấn đề nhất định

Wikipedia mô tả chúng  như sau

> Trong kỹ thuật phần mềm, một phần mềm được design pattern là một giải pháp tái sử dụng vấn đề chung cho một vấn đề thường xảy ra trong một bối cảnh nhất định trong thiết kế phần mềm. Nó không phải là một thiết kế hoàn chỉnh để có thể được chuyển đổi trực tiếp thành mã nguồn hoặc mã máy. Nó là một mô tả hoặc mẫu để giải quyết vấn đề có thể được sử dụng trong nhiều tình huống khác nhau.

⚠️ Hãy cẩn thận 
-----------------
- Design patterns không phải là một viên đạn bạc cho tất cả các vấn đề của bạn.
- Đừng cố bắt buộc dùng chúng; những điều xấu được cho là xảy ra, nếu làm như vậy. 
- Hãy nhớ rằng các design pattern là giải pháp cho các vấn đề, không phải giải pháp tìm ra vấn đề; vì vậy đừng quá suy nghĩ.
- Nếu được sử dụng đúng chỗ một cách chính xác, chúng có thể tỏ ra là một vị cứu tinh; hoặc người nào khác họ có thể dẫn đến một mớ hỗn độn kinh khủng của một code.

> Cũng lưu ý rằng các mẫu code dưới đây là trong PHP-7, tuy nhiên điều này không nên làm bạn dừng lại bởi vì các khái niệm giống nhau.

Các loại Design Patterns
-----------------

* [Creational](#creational-design-patterns)
* [Structural](#structural-design-patterns)
* [Behavioral](#behavioral-design-patterns)

Creational Design Patterns
==========================

Nói một cách đơn giản
> Creational pattern là tập trung hướng tới cách khởi tạo một đối tượng hoặc một nhóm các đối tượng liên quan.

Wikipedia nói
> Trong kỹ thuật phần mềm, creational design patterns là các design pattern mà đối phó với các cơ chế khởi tạo đối tượng, cố gắng khởi tạo các đối tượng theo cách phù hợp với tình huống. Các mẫu cơ bản khởi tạo đối tượng có thể dẫn đến các vấn đề về thiết kế hoặc thêm độ phức tạp vào thiết kế. Creational design patterns giải quyết vấn đề này bằng cách kiểm soát việc khởi tạo đối tượng này..

 * [Simple Factory](#-simple-factory)
 * [Factory Method](#-factory-method)
 * [Abstract Factory](#-abstract-factory)
 * [Builder](#-builder)
 * [Prototype](#-prototype)
 * [Singleton](#-singleton)

🏠 Simple Factory
--------------
Ví dụ thực tế
> Hãy xem xét, bạn đang xây dựng một ngôi nhà và bạn cần những cái cửa. Bạn có thể mặc quần áo thợ mộc, mang một ít gỗ, keo, móng tay và tất cả các công cụ cần thiết để làm cái cửa và bắt đầu làm nó trong nhà của bạn hoặc bạn có thể đơn giản chỉ cần gọi đến nhà máy và nhận được cánh cửa đã được làm giao cho bạn mà bạn không cần phải tìm hiểu bất cứ điều gì về việc làm cửa hoặc để đối phó với mớ hỗn độn mà đi kèm với việc làm nó.

Nói một cách đơn giản
> Simple factory chỉ cần tạo một thể hiện cho client mà không lộ bất kỳ sự logic khởi tạo nào cho client.

Wikipedia nói
> Trong lập trình hướng đối tượng (OOP), một factory là một đối tượng để tạo các đối tượng khác - một factory chính thức là một hàm hoặc phương thức mà trả về các đối tượng của một nguyên mẫu hoặc một lớp từ một vài lời gọi phương , được giả định là "mới".

**Ví dụ lập trình**

Trước hết chúng ta có một interface cho door và implementation
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
Sau đó chúng ta có một door factory của chúng ta để tạo door và trả về nó
```php
class DoorFactory
{
    public static function makeDoor($width, $height): Door
    {
        return new WoodenDoor($width, $height);
    }
}
```
Và sau đó nó có thể được sử dụng như sau
```php
// Make me a door of 100x200
$door = DoorFactory::makeDoor(100, 200);

echo 'Width: ' . $door->getWidth();
echo 'Height: ' . $door->getHeight();

// Make me a door of 50x100
$door2 = DoorFactory::makeDoor(50, 100);
```

**Khi nào sử dụng?**

Khi khởi tạo một đối tượng không chỉ là một vài assignments và involves some logic, nó có ý nghĩa để đặt nó trong một factory chuyên dụng thay vì lặp lại cùng một mã ở khắp mọi nơi.

🏭 Factory Method
--------------

Ví dụ thực tế
> Xem xét trường hợp của người quản lý tuyển dụng. Một người không thể phỏng vấn cho từng vị trí. Dựa trên công việc đưa ra, cô ấy phải quyết định và ủy nhiệm các bước phỏng vấn cho những người khác nhau.

Nói một cách đơn giản
> Nó cung cấp một cách để ủy quyền sự logic khởi tạo cho các class con.

Wikipedia nói
> Trong lập trình dựa trên class, factory method là một creational pattern sử dụng các factory method để xử lý vấn đề khởi tạo các đối tượng mà không cần phải chỉ định class chính xác của đối tượng sẽ được tạo ra. Điều này được thực hiện bằng cách khởi tạo các đối tượng bằng cách gọi một factory method — hoặc được chỉ định trong một interface và được thực hiện bởi các class con hoặc được thực hiện trong một class cơ sở và tùy ý bị ghi đè bởi các class gốc — thay vì gọi một hàm khởi tạo.

 **Ví dụ lập trình**

Lấy ví dụ người quản lý tuyển dụng của chúng tôi ở trên. Trước hết, chúng tôi có một interface cho người phỏng vấn và một số triển khai cho nó

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

Bây giờ chúng ta hãy tạo ra `HiringManager`

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
Bây giờ bất kỳ class con nào cũng có thể mở rộng và bắt buộc cung cấp cho người phỏng vấn

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
và sau đó nó có thể được sử dụng như

```php
$devManager = new DevelopmentManager();
$devManager->takeInterview(); // Output: Asking about design patterns

$marketingManager = new MarketingManager();
$marketingManager->takeInterview(); // Output: Asking about community building.
```

**Khi nào sử dụng?**

Hữu ích khi có một số xử lý chung trong một class nhưng class con được yêu cầu là được quyết định lịnh động động trong thời gian chạy. Hay nói cách khác, khi client không biết chính xác class con nào mà nó có thể cần.

🔨 Abstract Factory
----------------

Ví dụ thực tế
> Mở rộng ví dụ cửa của chúng ta từ Simple Factory. Dựa vào nhu cầu của bạn, bạn có thể nhận được một cánh cửa bằng gỗ từ một cửa hàng cửa gỗ, cửa sắt từ một cửa hàng sắt hoặc một cánh cửa nhựa PVC từ các cửa hàng có liên quan. Thêm vào đó bạn có thể cần một chàng trai với các kỹ năng riêng biệt khác nhau để phù hợp với cánh cửa, ví dụ như một thợ mộc cho cửa gỗ, thợ hàn cho cửa sắt vv. Như bạn có thể thấy có một sự phụ thuộc giữa các cánh cửa bây giờ, cửa gỗ cần thợ mộc, cửa sắt cần một thợ hàn vv.

Nói một cách đơn giản
> Một factory của các factory; một factory nhóm các cá nhân nhưng các nhà máy liên quan / phụ thuộc với nhau mà không cần chỉ rõ.

Wikipedia nói
> Abstract factory pattern cung cấp một cách để đóng gói một nhóm các factory riêng lẻ có một chủ đề chung mà không cần chỉ định các class cụ thể của chúng

**Ví dụ lập  trình**

Dịch ví dụ trên. Trước hết chúng ta có `Door` interface và một vài sự thực hiện cho nó

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
Sau đó, chúng tôi có một số chuyên gia phù hợp cho từng loại cửa

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

Bây giờ chúng ta có abstract factory của chúng ta sẽ cho phép chúng ta tạo một family của các đối tượng liên quan tức là nhà máy sản xuất cửa gỗ sẽ tạo ra một cánh cửa gỗ và chuyên gia lắp cửa gỗ và nhà máy sản xuất cửa sắt sẽ tạo ra một cánh cửa sắt và chuyên gia lắp cửa sắt

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
Và sau đó nó có thể được sử dụng như sau
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

Như bạn có thể thấy nhà máy sản xuất cửa gỗ đã đóng gói `carpenter` và `wooden door` cũng nhà máy cửa sắt đã đóng gói `iron door` và `welder`. Và do đó nó đã giúp chúng ta đảm bảo rằng đối với mỗi cánh cửa được tạo ra, chúng ta không nhận được một chuyên gia không phù hợp.

**Sử dụng khi nào**

Khi có sự phụ thuộc tương quan với logic khởi tạo mà không đơn giản


👷 Builder
--------------------------------------------
Ví dụ thực thế
> Hãy tưởng tượng bạn đang ở Hardee's và bạn đặt hàng một deal cụ thể, cho phép "Big Hardee" và họ giao lại cho bạn mà không có bất kỳ câu hỏi nào; đây là ví dụ về simple factory. Nhưng có những trường hợp khi logic khởi tạo có thể liên quan đến nhiều bước hơn. Ví dụ bạn muột một Subway deal tuỳ chỉnh, bạn có một số tùy chọn về cách thức làm bánh mì kẹp thịt của bạn, ví dụ: bạn muốn bánh mì nào? bạn muốn loại nước sốt nào? Bạn muốn phô mai nào? vv Trong trường hợp như vậy xây dựng mô hình đến để giải cứu

Nói đơn giản
> Cho phép bạn tạo ra các loại khác nhau của một đối tượng trong khi tránh ảnh hướng đến constructor. Hữu ích khi có thể có một số loại của một đối tượng. Hoặc khi có rất nhiều bước liên quan đến việc khởi tạo một đối tượng.

Wikipedia says
> builder pattern là một software design pattern khởi tạo đối tượng với ý định tìm kiếm một giải pháp cho the telescoping constructor anti-pattern.

Có nói rằng hãy để tôi thêm một chút về những gì constructor telescoping anti-pattern là. Tại một thời điểm hoặc khác, chúng tôi có tất cả cái nhìn về một contructor như dưới đây:


```php
public function __construct($size, $cheese = true, $pepperoni = true, $tomato = false, $lettuce = true)
{
}
```

Bạn có thể thấy, số lượng đối số truyền vào của contructor có thể nhanh chóng tuột khỏi tay và có thể trở nên khó khăn để hiểu được sắp xếp các đối số đó. Thêm vào danh sách đối số này có thể tiếp tục phát triển nếu bạn muốn thêm nhiều tùy chọn hơn trong tương lai. Điều này được gọi là telescoping constructor anti-pattern.

**Ví dụ lập  trình**

Cách thay thế tốt là sử dụng builder pattern. Trước hết, chúng ta có bánh mì kẹp thịt mà chúng ta muốn làm

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

Và sau đó chúng ta có builder

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
Và sau đó nó có thể được sử dụng như sau:

```php
$burger = (new BurgerBuilder(14))
                    ->addPepperoni()
                    ->addLettuce()
                    ->addTomato()
                    ->build();
```

**Sử dụng khi nào**

Khi có thể có một số loại của một đối tượng và để tránh avoid the constructor telescoping. Sự khác biệt chính từ factory pattern là; factory pattern được sử dụng khi khởi tạo là một quá trình một bước trong khi builder pattern được sử dụng khi tạo ra là một quá trình nhiều bước.

🐑 Prototype
------------
Ví dụ thực tế
> Nhớ lại dolly? Con cừu được nhân bản ! Cho phép không nhận vào các chi tiết nhưng điểm mấu chốt ở đây là nó là tất cả về nhân bản

Nói đơn giản 
> Tạo đối tượng dựa trên một đối tượng đã tồn tại thông qua việc nhân bản (clone).

Wikipedia nói
> The prototype pattern là một creational design pattern trong phát triển phần mềm. Nó được sử dụng khi loại của đối tượng cần khởi tạo được xác định bởi một thể hiện prototypical, được nhân bản để tạo ra các đối  tượng mới.

Tóm lại, nó cho phép bạn tạo một bản sao của một đối tượng hiện có và sửa đổi nó theo nhu cầu của bạn, thay vì trải qua những rắc rối khi tạo một đối tượng từ đầu và thiết lập nó.

**Ví dụ lập  trình**

Trong PHP, nó có thể dễ dàng thực hiện bằng cách sử dụng `clone`

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
Sau  đó nó có thể được nhân bản giống như dưới 
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

Bạn cũng có thể sử dụng magic method `__clone` để sửa đổi cloning behavior.

**Sử dụng khi nào**

Khi một đối tượng được yêu cầu tương tự như đối tượng hiện có hoặc khi việc tạo ra sẽ tốn chi phí hơn so với nhân bản.

💍 Singleton
------------
Ví dụ thực tế
> Mỗi lần chỉ có thể là một tổng thống của một quốc gia. Cùng một tổng thống phải được đưa ra hành động, bất cứ khi nào có nhiệm vụ. Tổng thống ở đây là singleton.

Nói đơn giản
> Đảm bảo rằng chỉ có một đối tượng của một class cụ thể được tạo ra.

Wikipedia nói
> Trong kỹ thuật phần mềm, singleton pattern là một software design pattern hạn chế sự khởi tạo của một claas thành một đối tượng. Điều này rất hữu ích khi cần một đối tượng chính xác để điều phối các hành động trên toàn hệ thống.

Singleton pattern thực sự được coi là anti-pattern và việc lạm dụng nó nên tránh. Nó không nhất thiết là xấu và có thể có một số trường hợp sử dụng hợp lệ nhưng nên được sử dụng thận trọng vì nó giới thiệu một trạng thái toàn cục trong ứng dụng của bạn và thay đổi nó ở một nơi có thể ảnh hưởng đến các khu vực khác và nó có thể trở nên khá khó khăn để gỡ lỗi .Điều tệ hại khác về chúng là nó làm cho code của bạn được kết hợp chặt chẽ cộng với mocking singleton có thể khó khăn

**Ví dụ lập  trình**

Tạo một singleton, tạo constructor private, vô hiệu hoá cloning, vô hiệu hó extension và tạo một biến static variable đến nhà của thể hiện 
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
Sau đó, để sử dụng
```php
$president1 = President::getInstance();
$president2 = President::getInstance();

var_dump($president1 === $president2); // true
```

Structural Design Patterns
==========================
Nói một cách đơn giản
> Structural patterns chủ yếu liên quan đến thành phần của đối tượng hay nói cách khác là cách các thực thể sử dụng lẫn nhau. Hoặc một lời giải thích khác là, chúng giúp trả lời "Làm thế nào để xây dựng một thành phần của phần mềm ?"

Wikipedia nói
> Trong kỹ thuật phần mềm, các structural design pattern là các mà để làm thiết kế dễ dàng bằng cách xác định một cách đơn giản để nhận ra mối quan hệ giữa các thực thể.

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
> Hãy xem xét giả sử bạn có một số ảnh trong thẻ nhớ của bạn và bạn cần chuyển chúng vào máy tính của bạn. Để chuyển chúng, bạn cần một loại chuyển đổi (adapter) phù hợp với cổng máy tính của bạn để bạn có thể gắn thẻ nhớ vào máy tính. Trong trường hợp này đầu đọc thẻ được gọi là bộ chuyển đổi (adapter). Một ví dụ khác là bộ chuyển đổi nguồn nổi tiếng, một cái phích cắm 3 chân không thể cắm vào ổ 2 chân, nó cần sử dụng một bộ chuyển đổi nguồn mà làm cho nó tương thích với loại 2 chân. Một ví dụ khác sẽ là một dịch giả dịch các từ được nói bởi một người khác.

Nói một cách đơn giản
> Adapter pattern cho phép bạn bao lại một đối tượng không tương thích khác trong một bộ chuyển đổi (adapter) để làm cho nó tương thích với một class khác.

Wikipedia nói
> Trong kỹ thuật phần mềm, adapter pattern là một software design pattern mà cho phép interface của một class đã tồn tại được sử dụng như một interface khác. Nó thường được sử dụng để làm cho các class đã tồn tại làm việc với các class khác mà không phải chỉ sửa code của chúng.

**Ví dụ lập  trình**

Xem xét một game nơi có một thợ săn (hunter) và anh ta săn sử tử(lion).

Đầu tiên chúng ta có một `Lion` mà tất cả các loại sư tử đều implement

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
Và thợ săn mong đợi mọi implementation của `Lion` interface để săn.
```php
class Hunter
{
    public function hunt(Lion $lion)
    {
        $lion->roar();
    }
}
```

Bây giờ giả sử chúng ta phải thêm một `WildDog` trong trò chơi của chúng ta để thợ săn có thể đi săn. Nhưng chúng ta không thể trực tiếp làm điều đó, bởi con chó có một interface khác. Để làm cho nó tương thích với interface của thợ săn, chúng ta sẽ tạo một adapter tương thích.

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

Nói một cách đơn giản
> Bridge pattern thì ưu tiên composition hơn inheritance. Chi tiết triển khai được đẩy từ một hệ thống phân cấp đến một đối tượng khác với một hệ thống phân cấp riêng biệt.

Wikipedia nói
> The bridge pattern là một design pattern sử dụng trong kỹ thuật phần mềm có nghĩa là "tách rời một sự trừu tượng khỏi việc thực hiện nó để hai phần có thể thay đổi một cách độc lập".

**Ví dụ lập  trình**

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

Nói một cách đơn giản
> Composite pattern cho phép client xử lý các đối tượng riêng lẻ theo cách thống nhất.

Wikipedia nói
> Trong sản xuất phần mền, composite pattern là một mẫu thiết kế phân vùng. Nó mô tả rằng một nhóm các đối tượng được xử lý giống như một phần tử đơn lẻ của một đối tượng. Mục đích của một composite là để "soạn" các đối tượng vào cấu trúc cây để đại diện cho toàn bộ hệ thống phân cấp. Việc triển khai composite pattern cho phép  các client xử lý các đối tượng và bố cục riêng lẻ một cách thống nhất.

**Ví dụ lập  trình**

Lấy ví dụ nhân viên của chúng ta từ trên. Ở đây chúng ta có các loại nhân viên khác nhau

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

Sau đó, chúng tôi có một tổ chức bao gồm nhiều loại nhân viên khác nhau

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

> Hãy tưởng tượng bạn chạy một cửa hàng dịch vụ xe hơi cung cấp nhiều dịch vụ. Bây giờ làm thế nào bạn tính toán hóa đơn ? Bạn chọn một dịch vụ và tự động tiếp tục bổ sung giá cho các dịch vụ được cung cấp cho đến khi bạn nhận được chi phí cuối cùng. Ở đây mỗi loại dịch vụ là một decorator.

Nói một cách đơn giản
> Decorator pattern cho phép bạn tự động thay đổi hành vi của một đối tượng trong thời gian chạy bằng cách gói chúng trong một đối tượng của một decorator class.

Wikipedia nói
> Trong lập trình hướng đối tượng, decorator pattern là một design pattern mà cho phép  hành vi được thêm vào một đối tượng riêng lẻ, tĩnh hoặc động, mà không ảnh hưởng đến hành vi của các đối tượng khác từ cùng một class. Decorator pattern thường hữu ích cho the Single Responsibility Principle, vì nó cho phép chức năng được phân chia giữa các lớp với các lĩnh vực quan tâm duy nhất.

**Ví dụ lập  trình**

Lấy cafe cho ví dụ. Đầu tiên chúng ta có một coffe đơn giản thực hiện implementing với coffee interface

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

Bây giờ hãy thực hiện một coffee

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

**Ví dụ lập  trình**

Lấy ví dụ máy tính của chúng tôi từ trên. Ở đây chúng ta có class máy tính

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
> Nó được sử dụng để giảm thiểu mức sử dụng bộ nhớ hoặc chi phí tính toán bằng cách chia sẻ càng nhiều càng tốt với các đối tượng tương tự.

Wikipedia nói
> Trong lập trình máy tính, flyweight là một software design pattern. Một flyweight là một đối tượng giảm thiểu việc sử dụng bộ nhớ bằng cách chia sẻ càng nhiều dữ liệu càng tốt với các đối tượng tương tự khác, nó là một cách để sử dụng các đối tượng với số lượng lớn khi một biểu diễn lặp lại đơn giản sẽ sử dụng một lượng bộ nhớ không thể chấp nhận được.

**Ví dụ lập  trình**

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

**Ví dụ lập  trình**

Lấy ví dụ cửa an ninh của chúng tôi từ trên. Đầu tiên chúng ta có door interface và một implementation của door

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
Sau đó, chúng tôi có một proxy để bảo đảm bất kỳ cửa nào mà chúng ta muốn
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
Một ví dụ khác sẽ là một loại data-mapper implementation. Ví dụ, gần đây tôi đã làm một ODM (Object Data Mapper) cho MongoDB sử dụng pattern này nơi tôi viết một proxy xung quanh lớp Mongo trong khi sử dụng phương thức magic `__call()`. Tất cả các lời gọi phương thức đã được ủy nhiệm cho lớp mongo ban đầu và kết quả được truy xuất đã được trả về vì nó là  `find` hoặc `findOne` data đã được ánh xạ tới các đối tượng lớp được yêu cầu và đối tượng đã được trả về thay vì `Cursor`.

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

**Ví dụ lập  trình**

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

**Ví dụ lập  trình**

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

**Ví dụ lập  trình**

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

**Ví dụ lập  trình**

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

**Ví dụ lập  trình**

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

**Ví dụ lập  trình**

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

**Ví dụ lập  trình**

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

**Ví dụ lập  trình**

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

**Ví dụ lập  trình**

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

**Ví dụ lập  trình**

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
