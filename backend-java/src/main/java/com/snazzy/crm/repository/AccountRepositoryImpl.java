package com.snazzy.crm.repository;

import com.snazzy.crm.dto.AccountSearch;
import com.snazzy.crm.model.Account;
import com.snazzy.crm.model.Contact;
import com.snazzy.crm.search.SearchRepository;
import jakarta.persistence.EntityManager;
import jakarta.persistence.PersistenceContext;
import jakarta.persistence.TypedQuery;
import jakarta.persistence.criteria.*;
import lombok.AllArgsConstructor;
import org.springframework.data.domain.PageImpl;
import org.springframework.data.domain.Pageable;

import java.util.ArrayList;
import java.util.List;

@AllArgsConstructor
public class AccountRepositoryImpl implements SearchRepository<Account, AccountSearch> {
    @PersistenceContext
    private EntityManager entityManager;

    public List<Account> search(AccountSearch search) {
        CriteriaBuilder cb = entityManager.getCriteriaBuilder();
        CriteriaQuery<Account> query = cb.createQuery(Account.class);
        Root<Account> root = query.from(Account.class);

        Join<Account, Contact> contactJoin = root.join("contacts", JoinType.LEFT);
        List<Predicate> predicates = this.getSearchPredicts(search, contactJoin);
        if (!predicates.isEmpty()) {
            query.where(cb.and(predicates.toArray(new Predicate[0])));
        }

        query.select(root).distinct(true);
        query.orderBy(cb.asc(root.get("id")));

        return entityManager.createQuery(query).getResultList();
    }

    @Override
    public List<Account> search(AccountSearch search, Pageable pageable) {
        CriteriaBuilder cb = entityManager.getCriteriaBuilder();
        CriteriaQuery<Account> query = cb.createQuery(Account.class);
        Root<Account> root = query.from(Account.class);

        Join<Account, Contact> contactJoin = root.join("contacts", JoinType.LEFT);
        List<Predicate> predicates = this.getSearchPredicts(search, contactJoin);

        if (!predicates.isEmpty()) {
            query.where(cb.and(predicates.toArray(new Predicate[0])));
        }

        query.select(root).distinct(true);
        query.orderBy(cb.asc(root.get("id")));

        TypedQuery<Account> typedQuery = entityManager.createQuery(query);
        typedQuery.setFirstResult((int) pageable.getOffset());
        typedQuery.setMaxResults(pageable.getPageSize());

        return new PageImpl<>(typedQuery.getResultList(), pageable, this.getTotal(search)).getContent();
    }

    @Override
    public Long getTotal(AccountSearch search) {
        CriteriaBuilder cb = entityManager.getCriteriaBuilder();
        CriteriaQuery<Long> countQuery = cb.createQuery(Long.class);
        Root<Account> countRoot = countQuery.from(Account.class);
        Join<Account, Contact> contactJoin = countRoot.join("contacts", JoinType.LEFT);
        List<Predicate> predicates = this.getSearchPredicts(search, contactJoin);
        if (!predicates.isEmpty()) {
            countQuery.where(cb.and(predicates.toArray(new Predicate[0])));
        }

        countQuery.select(cb.countDistinct(countRoot));
        return entityManager.createQuery(countQuery).getSingleResult();
    }

    private List<Predicate> getSearchPredicts(AccountSearch search, Join<Account, Contact> contactJoin) {
        CriteriaBuilder cb = entityManager.getCriteriaBuilder();
        List<Predicate> predicates = new ArrayList<>();

        if (search.getUnassigned() != null) {
            if (search.getUnassigned()) {
                predicates.add(cb.isNull(contactJoin.get("id")));
            } else {
                predicates.add(cb.isNotNull(contactJoin.get("id")));
            }
        }

        if (search.getQuery() != null) {
            predicates.add(cb.equal(contactJoin.get("phoneNumber"), search.getQuery()));
        }

        return predicates;
    }

}
