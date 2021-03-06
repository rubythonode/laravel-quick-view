<?php

namespace Armandsar\QuickView\Tests {

    use App\Http\Controllers\Admin\SpecialHelpersController;
    use App\Http\Controllers\HelpersController;
    use Illuminate\Contracts\View\Factory as ViewFactory;
    use Orchestra\Testbench\TestCase as OrchestraTestCase;

    class HelperTest extends OrchestraTestCase
    {
        public function testHelperFunction()
        {
            $viewFactory = \Mockery::mock(ViewFactory::class);

            app()->instance(ViewFactory::class, $viewFactory);

            $viewFactory->shouldReceive('make')
                ->with('admin.special_helpers.special_index', ['a' => 1], ['b' => 2])
                ->once();

            $viewFactory->shouldReceive('make')
                ->with('helpers.create', [], [])
                ->once();

            (new SpecialHelpersController)->specialIndex();
            (new HelpersController())->create();
        }

    }

}

namespace App\Http\Controllers {

    class HelpersController
    {
        public function create()
        {
            return quick();
        }
    }
}

namespace App\Http\Controllers\Admin {

    class SpecialHelpersController
    {
        public function specialIndex()
        {
            return quick(['a' => 1], ['b' => 2]);
        }
    }

}