<?php

namespace YT\CustomerRegisterForm\Controller\Form;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Psr\Log\LoggerInterface;
use YT\CustomerRegisterForm\Api\Data\CustomerProfileInterfaceFactory as CustomerProfileInterfaceFactory;

class Save extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\Data\Form\FormKey\Validator
     */
    protected $formKeyValidator;
    /**
     * @var \YT\CustomerRegisterForm\Api\CustomerProfileRepositoryInterface
     */
    protected $customerProfileRepository;
    /**
     * @var LoggerInterface
     */
    protected $logger;
    /**
     * @var CustomerProfileInterfaceFactory
     */
    protected $customerProfileFactory;

    /**
     * Save constructor.
     *
     * @param Context $context
     * @param \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
     * @param \YT\CustomerRegisterForm\Api\CustomerProfileRepositoryInterface $customerProfileRepository
     * @param LoggerInterface $logger
     * @param CustomerProfileInterfaceFactory $customerProfileFactory
     */
    public function __construct(
        Context $context,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        \YT\CustomerRegisterForm\Api\CustomerProfileRepositoryInterface $customerProfileRepository,
        LoggerInterface $logger,
        CustomerProfileInterfaceFactory $customerProfileFactory
    ) {
        parent::__construct($context);
        $this->formKeyValidator = $formKeyValidator;
        $this->customerProfileRepository = $customerProfileRepository;
        $this->logger = $logger;
        $this->customerProfileFactory = $customerProfileFactory;
    }

    public function execute()
    {
        /** @var Http $request */
        $request = $this->getRequest();
        try {
            $name = $request->getPost('name');
            $email = $request->getPost('email');
            $phone = $request->getPost('phone');
            $address = $request->getPost('address');
            $countryCode = $request->getPost('country_id');

            /** @var \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface $model */
            $model = $this->customerProfileFactory->create();
            $model->setName($name)
                ->setEmail($email)
                ->setPhone($phone)
                ->setAddress($address)
                ->setCountryCode($countryCode);
            $this->customerProfileRepository->save($model);
            $this->messageManager->addSuccessMessage('Data Saved successfully');
        } catch (\Exception $e) {
            $this->logger->error('CustomerRegisterForm Error: ' . $e->getMessage());
            $this->messageManager->addErrorMessage(__('Something wrong happened when form data saving. Try latter'));
        }

        $this->_redirect('/');
    }
}
