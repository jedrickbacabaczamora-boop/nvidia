use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalProofsTable extends Migration
{
    public function up()
    {
        Schema::create('withdrawal_proofs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->text('comment')->nullable();
            $table->string('photo')->nullable();
            $table->bigInteger('like')->default(0);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('approved')->comment("1=>success, 2=>pending, 3=>cancel");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('withdrawal_proofs');
    }
}
