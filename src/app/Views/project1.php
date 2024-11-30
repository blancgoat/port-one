<!DOCTYPE html>
<html>
<script src="https://cdn.iamport.kr/v1/iamport.js"></script>
<script>
    function requestPay() {
        const formData = new FormData(document.getElementById('paymentForm'));
        IMP.init("<?=getenv('IMP')?>");
        IMP.request_pay(
            {
                channelKey: "<?=getenv('channelKey')?>",
                pay_method: "card",
                merchant_uid: formData.get('order_uid'),
                name: formData.get('product_name'),
                amount: formData.get('amount'),
                buyer_email: "gildong@gmail.com",
                buyer_name: "홍길동",
                buyer_tel: "010-4242-4242",
                buyer_addr: "서울특별시 강남구 신사동",
                buyer_postcode: "01181",
            },
            async (response) => {
                if (response.error_code != null) {
                    return alert(`결제에 실패하였습니다. 에러 내용: ${response.error_msg}`);
                }
                return alert("결제가 성공적으로 처리되었습니다");
            },
        );
    }
</script>
<form id="paymentForm">
    <div><label for="order_uid">가맹점 주문번호</label> <input type="text" id="order_uid" name="order_uid" required>
    </div>
    <div><label for="product_name">결제대상 제품명</label> <input type="text" id="product_name" name="product_name" required>
    </div>
    <div><label for="amount">결제금액</label> <input type="number" id="amount" name="amount" required></div>
    <button type="button" onclick="requestPay()">결제</button>
</form>
</html>