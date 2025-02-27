<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Exception\Handler;

use App\Components\Response;
use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\ExceptionHandler\Formatter\FormatterInterface;
use Hyperf\HttpMessage\Exception\HttpException;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class AppExceptionHandler extends ExceptionHandler
{
    /**
     * @var StdoutLoggerInterface
     */
    protected $logger;


    #[Inject]
    protected Response $response;


    public function __construct(StdoutLoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $formatter = make(FormatterInterface::class);

//        if($throwable instanceof \ErrorException){
//            $this->logger->error($throwable->getMessage());
//        }

        //业务异常处理
        if ($throwable instanceof BusinessException) {
            return $this->response->fail($throwable->getCode(), $throwable->getMessage());
        }

        // 针对表单的异常处理
        if ($throwable instanceof ValidationException) {
            $message = $throwable->validator->errors()->first();
            return $this->response->fail(ErrorCode::FORM_ERROR, $message);
        }

        //HttpException
        if ($throwable instanceof HttpException) {
            // 阻止异常冒泡
            $this->stopPropagation();
            return $this->response->fail($throwable->getStatusCode(), $throwable->getMessage());
        }

        $this->logger->error($formatter->format($throwable));


        return $this->response->fail(500, env('APP_ENV') == 'dev' ? $throwable->getMessage() : 'Server Error');

//        $formatter = ApplicationContext::getContainer()->get(FormatterInterface::class);
//        $this->logger->error(sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile()));
//        $this->logger->error($throwable->getTraceAsString());
//        return $response->withHeader('Server', 'Hyperf')->withStatus(500)->withBody(new SwooleStream('Internal Server Error.'));
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
