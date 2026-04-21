<?php

namespace App\Infrastructure\Client\Http\EventSubcriber;

use App\Domain\Client\Exception\EmailAlreadyExistException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ClientExceptionSubcriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => ['onKernelException',10]
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if($exception instanceof EmailAlreadyExistException){
            $event->setResponse(new JsonResponse(
                ['message'=>$exception->getMessage()],
                JsonResponse::HTTP_CONFLICT
            ));
        }
    }
}