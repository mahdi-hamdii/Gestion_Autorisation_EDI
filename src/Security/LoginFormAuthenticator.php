<?php
namespace App\Security;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\AuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\PasswordUpgradeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

class LoginFormAuthenticator extends AbstractAuthenticator {

    private $userRepository;
    private $urlGenerator;

    public function __construct(UserRepository $userRepository, UrlGeneratorInterface $urlGenerator)
    {
        $this->userRepository= $userRepository;
        $this->urlGenerator= $urlGenerator;
    }

    public function supports(\Symfony\Component\HttpFoundation\Request $request): ?bool
    {
        return $request->attributes->get('_route')=== 'security_login' &&
            $request->isMethod('POST');
    }

    public function authenticate(\Symfony\Component\HttpFoundation\Request $request): \Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface
    {
        $user = $this->userRepository->findOneBy(['email'=>$request->request->get('email')]);
        $request->getSession()->set('login_email',$request->request->get('email'));
        $request->getSession()->set('user',$user);

        if(!$user){
            throw new UsernameNotFoundException();
        }
        return new Passport(
            $user,
            new PasswordCredentials($request->request->get('password')),[
            new CsrfTokenBadge('login_form', $request->get('csrf_token')),
            new RememberMeBadge()
            ]);

    }

    public function onAuthenticationSuccess(\Symfony\Component\HttpFoundation\Request $request, \Symfony\Component\Security\Core\Authentication\Token\TokenInterface $token, string $firewallName): ?\Symfony\Component\HttpFoundation\Response
    {
        return new RedirectResponse($this->urlGenerator->generate('personne'));
    }

    public function onAuthenticationFailure(\Symfony\Component\HttpFoundation\Request $request, \Symfony\Component\Security\Core\Exception\AuthenticationException $exception): ?\Symfony\Component\HttpFoundation\Response
    {
        $request->getSession()->getFlashBag()->add('error', 'invalid credentials');
        return new RedirectResponse($this->urlGenerator->generate('security_login'));
    }
}
