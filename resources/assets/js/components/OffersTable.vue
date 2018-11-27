<template>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Employer Name</th>
            <th>Employer Company Name</th>
            <th>Participant Name</th>
            <th>Added At</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            <tr v-for="offer in offers">
                <td>{{ offer.employer.name}}</td>
                <td>{{ offer.employer.company_info}}</td>
                <td>{{ offer.participant.firstName}} {{ offer.participant.lastName }}</td>
                <td>{{ offer.created_at }}</td>
                <td v-if="!offer.is_approved">
                    <button @click="makeApprove(offer)" class="btn btn-success btn-xs">approve</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        mounted() {
        },
        props:['offers', 'approved'],
        methods: {
            makeApprove(offer){
                var loffer = this.offers.find( (l) => {
                    return l.id === offer.id
                })
                var index = this.offers.indexOf(loffer)
                this.offers.splice(index, 1)
                console.log(this.offers)

            }
        }
    }
</script>
